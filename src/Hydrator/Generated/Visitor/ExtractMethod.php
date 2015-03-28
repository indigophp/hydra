<?php

/*
 * This file is part of the Indigo Hydra package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Hydra\Hydrator\Generated\Visitor;

use PhpParser\Node\Param;
use PhpParser\Node\Stmt\ClassMethod;

/**
 * Generates the hydrate method
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class ExtractMethod extends HydratorMethods
{
    /**
     * {@inheritdoc}
     */
    protected function getMethodName()
    {
        return 'extract';
    }

    /**
     * {@inheritdoc}
     */
    protected function replaceMethod(ClassMethod $method)
    {
        $method->params = [new Param('object')];

        if (empty($this->accessibleProperties) && empty($this->propertyWriters)) {
            // if no properties to hydrate
            $body = 'return [];';
        } else {
            $body = $this->initialBody();

            $body .= sprintf(
                "return [\n%s%s];",
                $this->buildAccessibleProperties(),
                $this->buildPropertyWriters()
            );
        }


        $method->stmts = $this->parser->parse('<?php ' . $body);
    }

    /**
     * Builds the initial body
     *
     * @return string
     */
    protected function initialBody()
    {
        if (!empty($this->propertyWriters)) {
            return "\$data = (array) \$object;\n\n";
        }

        return '';
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
        return "    ".vsprintf($template, $arguments)."\n";
    }

    /**
     * Builds accessible properties
     *
     * @return string
     */
    protected function buildAccessibleProperties()
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
     * Builds property writers
     *
     * @return string
     */
    protected function buildPropertyWriters()
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
}
