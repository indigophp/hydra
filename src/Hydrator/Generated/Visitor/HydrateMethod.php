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
class HydrateMethod extends HydratorMethods
{
    /**
     * {@inheritdoc}
     */
    protected function getMethodName()
    {
        return 'hydrate';
    }

    /**
     * {@inheritdoc}
     */
    protected function replaceMethod(ClassMethod $method)
    {
        $method->params = [
            new Param('object'),
            new Param('data', null, 'array'),
        ];

        $body = $this->buildAccessibleProperties();
        $body .= $this->buildPropertyWriters();

        $method->stmts = $this->parser->parse('<?php ' . $body);
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
            $body .= sprintf(
                '$object->%s = $data[%s];',
                $accessibleProperty->getName(),
                var_export($accessibleProperty->getName(), true)
            )."\n";
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
            $body .= sprintf(
                '$this->%s->__invoke($object, $data[%s]);',
                $propertyWriter->props[0]->name,
                var_export($propertyWriter->getOriginalProperty()->getName(), true)
            )."\n";
        }

        return $body;
    }
}
