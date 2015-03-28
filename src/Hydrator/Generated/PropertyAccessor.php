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

use CodeGenerationUtils\Inflector\Util\UniqueIdentifierGenerator;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\PropertyProperty;

/**
 * Property node that contains a {@see \ReflectionProperty} that functions as an accessor
 * for inaccessible proxied object's properties.
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 */
class PropertyAccessor extends Property
{
    /**
     * @var \ReflectionProperty
     */
    protected $accessedProperty;

    /**
     * @param \ReflectionProperty $accessedProperty
     * @param string              $nameSuffix
     */
    public function __construct(\ReflectionProperty $accessedProperty, $nameSuffix)
    {
        $this->accessedProperty = $accessedProperty;

        $originalName = $accessedProperty->getName();
        $name = UniqueIdentifierGenerator::getIdentifier($originalName.$nameSuffix);

        parent::__construct(
            Class_::MODIFIER_PRIVATE,
            [new PropertyProperty($name)]
        );
    }

    /**
     * @return \ReflectionProperty
     */
    public function getOriginalProperty()
    {
        return $this->accessedProperty;
    }
}
