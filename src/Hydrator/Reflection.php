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
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Reflection extends Base
{
    /**
     * In-memory array cache of ReflectionProperties
     *
     * @var \ReflectionProperty[]
     */
    private static $reflectionProperties = [];

    /**
     * {@inheritdoc}
     */
    public function hydrate($object, array $data)
    {
        $this->ensureObject($object);

        $properties = self::getReflectionProperties($object);

        foreach ($data as $key => $value) {
            if (isset($properties[$key])) {
                $properties[$key]->setValue($object, $value);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function extract($object)
    {
        $this->ensureObject($object);

        $data = [];
        $properties = self::getReflectionProperties($object);

        foreach ($properties as $name => $property) {
            $data[$name] = $property->getValue($object);
        }

        return $data;
    }

    /**
     * Returns reflection properties from in-memory cache or load them
     *
     * @param object $object
     *
     * @return \ReflectionProperty[]
     */
    private static function getReflectionProperties($object)
    {
        $class = get_class($object);

        if (!isset(self::$reflectionProperties[$class])) {
            $reflection = new \ReflectionClass($object);
            $properties = [];

            foreach ($reflection->getProperties() as $property) {
                // We only need object context properties???
                if (!$property->isStatic()) {
                    // Is it always necessary?
                    $property->setAccessible(true);

                    $properties[$property->getName()] = $property;
                }
            }

            self::$reflectionProperties[$class] = $properties;
        }

        return self::$reflectionProperties[$class];
    }
}
