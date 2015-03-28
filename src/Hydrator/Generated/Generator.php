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

use CodeGenerationUtils\ReflectionBuilder\ClassBuilder;
use CodeGenerationUtils\Visitor\ClassExtensionVisitor;
use CodeGenerationUtils\Visitor\ClassImplementorVisitor;
use CodeGenerationUtils\Visitor\ClassRenamerVisitor;
use CodeGenerationUtils\Visitor\MethodDisablerVisitor;
use PhpParser\NodeTraverser;

/**
 * Hydrator Class generator
 *
 * Heavily inspired by GeneratedHydrator
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Generator
{
    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @param Configuration|null $configuration
     */
    public function __construct(Configuration $configuration = null)
    {
        if (!isset($configuration)) {
            $configuration = new Configuration;
        }

        $this->configuration = $configuration;
    }

    /**
     * Returns a hydrator class for a class name
     *
     * @param string $class
     *
     * @return string
     */
    public function getHydratorClass($class)
    {
        $inflector = $this->configuration->getInflector();

        $realClass = $inflector->getUserClassName($class);
        $hydratorClass = $inflector->getGeneratedClassName($realClass, ['generator' => get_class($this)]);

        if (!class_exists($hydratorClass)) {
            $ast = $this->generateAst($realClass, $hydratorClass);

            $this->configuration->getGeneratorStrategy()->generate($ast);
            $this->configuration->getAutoloader()->__invoke($hydratorClass);
        }

        return $hydratorClass;
    }

    /**
     * Generates an AST out of a given reflection class and a target hydrator name
     *
     * @param string $realClass
     * @param string $hydratorClass
     *
     * @return \PhpParser\Node[]
     */
    protected function generateAst($realClass, $hydratorClass)
    {
        $originalClass = new \ReflectionClass($realClass);
        $builder = new ClassBuilder;
        $traverser = new NodeTraverser;

        $ast = $builder->fromReflection($originalClass);

        // Remove unused methods
        $traverser->addVisitor(new MethodDisablerVisitor(function() { return false; }));

        $accessibleProperties = $this->getProperties(
            $originalClass,
            \ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED
        );

        $propertyWriters = $this->getPropertyWriters($originalClass);

        // Implement new methods and interfaces, extend original class
        $traverser->addVisitor(new Visitor\ConstructorMethod($accessibleProperties, $propertyWriters));
        $traverser->addVisitor(new Visitor\HydrateMethod($accessibleProperties, $propertyWriters));
        $traverser->addVisitor(new Visitor\ExtractMethod($accessibleProperties, $propertyWriters));

        $traverser->addVisitor(new ClassExtensionVisitor($realClass, $realClass));
        $traverser->addVisitor(new ClassImplementorVisitor($realClass, ['Indigo\\Hydra\\Hydrator']));

        // Renames class
        $traverser->addVisitor(new ClassRenamerVisitor($originalClass, $hydratorClass));

        return $traverser->traverse($ast);
    }

    /**
     * Retrieves instance public/protected properties
     *
     * @param \ReflectionClass $originalClass
     * @param integer          $filter
     *
     * @return \ReflectionProperty[]
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

    /**
     * Retrieves instance of private property writers
     *
     * @param \ReflectionClass $originalClass
     *
     * @return PropertyAccessor[]
     */
    protected function getPropertyWriters(\ReflectionClass $originalClass)
    {
        $propertyWriters = $this->getProperties($originalClass, \ReflectionProperty::IS_PRIVATE);

        foreach ($propertyWriters as &$property) {
            $property = new PropertyAccessor($property, 'Writer');
        }

        return $propertyWriters;
    }
}
