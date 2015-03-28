<?php

/*
 * This file is part of the Indigo Hydra package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Hydra\Hydrator\Generated;

use PhpParser\Lexer;
use PhpParser\Node;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Parser;

/**
 * Visitor for adding hydrator methods to the generated class
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @link https://github.com/Ocramius/GeneratedHydrator/blob/master/src/GeneratedHydrator/CodeGenerator/Visitor/HydratorMethodsVisitor.php
 */
class HydratorMethodsVisitor extends NodeVisitorAbstract
{
    /**
     * @var \ReflectionClass
     */
    protected $originalClass;

    /**
     * @var \ReflectionProperty[]
     */
    protected $accessibleProperties;

    /**
     * @var \PropertyAccessor[]
     */
    protected $propertyWriters = [];

    /**
     * @var Parser
     */
    protected $parser;

    /**
     * @param \ReflectionClass $originalClass
     */
    public function __construct(\ReflectionClass $originalClass)
    {
        $this->originalClass = $originalClass;
        $this->accessibleProperties = $this->getProperties(
            $originalClass,
            \ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED
        );

        foreach ($this->getProperties($originalClass, \ReflectionProperty::IS_PRIVATE) as $property) {
            $this->propertyWriters[$property->getName()] = new PropertyAccessor($property, 'Writer');
        }

        $this->parser = new Parser(new Lexer());
    }
    /**
     * @param Node $node
     *
     * @return null|Class_|void
     */
    public function leaveNode(Node $node)
    {
        if (!$node instanceof Class_) {
            return null;
        }

        $this->replaceConstructor($this->findOrCreateMethod($node, '__construct'));
        $this->replaceHydrate($this->findOrCreateMethod($node, 'hydrate'));
        $this->replaceExtract($this->findOrCreateMethod($node, 'extract'));

        return $node;
    }

    /**
     * @param ClassMethod $method
     */
    protected function replaceConstructor(ClassMethod $method)
    {
        $method->params = [];
        $bodyParts = [];

        foreach ($this->propertyWriters as $propertyWriter) {
            $accessorName = $propertyWriter->props[0]->name;
            $originalProperty = $propertyWriter->getOriginalProperty();
            $className = $originalProperty->getDeclaringClass()->getName();
            $property = $originalProperty->getName();
            $stringClassName = var_export($className, true);

            $bodyParts[] = <<<PART
\$this->$accessorName = \\Closure::bind(function(\$object, \$value) {
    \$object->$property = \$value;
}, null, $stringClassName);
PART;
        }

        $method->stmts = $this->parser->parse('<?php ' . implode("\n", $bodyParts));
    }

    /**
     * @param ClassMethod $method
     */
    protected function replaceHydrate(ClassMethod $method)
    {
        $method->params = [
            new Param('object'),
            new Param('data', null, 'array'),
        ];

        $body = $this->buildHydrateAccessibleProperties();
        $body .= $this->buildHydratePropertyWriters();

        $method->stmts = $this->parser->parse('<?php ' . $body);
    }

    /**
     * Builds hydrate accessible properties
     *
     * @return string
     */
    protected function buildHydrateAccessibleProperties()
    {
        $body = '';

        foreach ($this->accessibleProperties as $accessibleProperty) {
            $body .= sprintf(
                '$object->%s = $data[%s];',
                $accessibleProperty->getName(),
                var_export($accessibleProperty->getName(), true)
            )."\n";
        }

        return $body;
    }

    /**
     * Builds hydrate property writers
     *
     * @return string
     */
    protected function buildHydratePropertyWriters()
    {
        $body = '';

        foreach ($this->propertyWriters as $propertyWriter) {
            $body .= sprintf(
                '$this->%s->__invoke($object, $data[%s]);',
                $propertyWriter->props[0]->name,
                var_export($propertyWriter->getOriginalProperty()->getName(), true)
            )."\n";
        }

        return $body;
    }

    /**
     * @param ClassMethod $method
     */
    protected function replaceExtract(ClassMethod $method)
    {
        $method->params = [new Param('object')];

        if (empty($this->accessibleProperties) && empty($this->propertyWriters)) {
            // no properties to hydrate
            $method->stmts = $this->parser->parse('<?php return [];');

            return;
        }

        $body = '';

        if (!empty($this->propertyWriters)) {
            $body = "\$data = (array) \$object;\n\n";
        }

        $body .= 'return [';
        $body .= $this->buildExtractAccessibleProperties();
        $body .= $this->buildExtractPropertyWriters();
        $body .= "\n];";

        $method->stmts = $this->parser->parse('<?php ' . $body);
    }

    /**
     * Builds an extract property
     *
     * @param string   $template
     * @param string[] $arguments
     *
     * @return string
     */
    protected function buildExtractProperty($template, array $arguments)
    {
        return "\n    ".vsprintf($template, $arguments);
    }

    /**
     * Builds extract accessible properties
     *
     * @return string
     */
    protected function buildExtractAccessibleProperties()
    {
        $body = '';

        foreach ($this->accessibleProperties as $accessibleProperty) {
            $propertyName = $accessibleProperty->getName();
            $exportedPropertyName = var_export($propertyName, true);

            if (empty($this->propertyWriters) || ! $accessibleProperty->isProtected()) {
                $body .= $this->buildExtractProperty('%s => $object->%s,', [$exportedPropertyName, $propertyName]);
            } else {
                $body .= $this->buildExtractProperty('%s => $data["\\0*\\0%s"],', [$exportedPropertyName, $propertyName]);
            }
        }

        return $body;
    }

    /**
     * Builds extract property writers
     *
     * @return string
     */
    protected function buildExtractPropertyWriters()
    {
        $body = '';

        foreach ($this->propertyWriters as $propertyWriter) {
            $property = $propertyWriter->getOriginalProperty();
            $propertyName = $property->getName();

            $body .= $this->buildExtractProperty(
                '%s => $data["\\0%s\\0%s"],',
                [
                    var_export($propertyName, true),
                    $property->getDeclaringClass()->getName(),
                    $propertyName,
                ]
            );
        }

        return $body;
    }

    /**
     * Finds or creates a class method (and eventually attaches it to the class itself)
     *
     * @param Class_ $class
     * @param string $name
     *
     * @return ClassMethod
     */
    protected function findOrCreateMethod(Class_ $class, $name)
    {
        $foundMethods = array_filter(
            $class->getMethods(),
            function (ClassMethod $method) use ($name) {
                return $name === $method->name;
            }
        );

        $method = reset($foundMethods);

        if (!$method) {
            $class->stmts[] = $method = new ClassMethod($name);
        }

        return $method;
    }

    /**
     * Retrieves instance public/protected properties
     *
     * @param \ReflectionClass $originalClass
     * @param integer          $filter
     *
     * @return ReflectionProperty[]
     */
    protected function getProperties(\ReflectionClass $originalClass, $filter = null)
    {
        return array_filter(
            $originalClass->getProperties($filter),
            function (\ReflectionProperty $property) {
                return ! $property->isStatic();
            }
        );
    }
}
