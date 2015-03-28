<?php

/*
 * This file is part of the Indigo Hydra package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Hydra\Hydrator;

/**
 * Basic Hydrator functions
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class PublicProperty extends Base
{
    /**
     * @var array[]
     */
    private static $propertiesCache = [];

    /**
     * {@inheritdoc}
     */
    public function hydrate($object, array $data)
    {
        $this->ensureObject($object);

        $properties = & self::$propertiesCache[get_class($object)];

        // Reflection is slow, we use get_object_vars to get the names as well
        if (!isset($properties)) {
            $objectProperties = get_object_vars($object);

            $properties = array_fill_keys(array_keys($objectProperties), true);
        }

        $validData = array_intersect_key($data, $properties);

        foreach ($validData as $name => $value) {
            $object->$name = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function extract($object)
    {
        $this->ensureObject($object);

        return get_object_vars($object);
    }
}
