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

use PhpParser\Node\Stmt\ClassMethod;

/**
 * Generates the __constructor method
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class ConstructorMethod extends HydratorMethods
{
    /**
     * {@inheritdoc}
     */
    protected function getMethodName()
    {
        return '__construct';
    }

    /**
     * {@inheritdoc}
     */
    protected function replaceMethod(ClassMethod $method)
    {
        $method->params = [];
        $body = '';

        foreach ($this->propertyWriters as $propertyWriter) {
            $accessorName = $propertyWriter->props[0]->name;
            $originalProperty = $propertyWriter->getOriginalProperty();
            $className = $originalProperty->getDeclaringClass()->getName();
            $property = $originalProperty->getName();
            $stringClassName = var_export($className, true);

            $body .= <<<PART
\$this->$accessorName = \\Closure::bind(function(\$object, \$value) {
    \$object->$property = \$value;
}, null, $stringClassName);

PART;
        }

        $method->stmts = $this->parser->parse('<?php ' . $body);
    }
}
