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
class ObjectProperty extends Base
{
    /**
     * @var array[]
     */
    private static $publicPropertiesCache = [];

    /**
     * @var \Closure
     */
    private static $hydratorClosure;

    /**
     * @var \Closure
     */
    private static $extractorClosure;

    /**
     * {@inheritdoc}
     */
    public function hydrate($object, array $data)
    {
        $this->ensureObject($object);

        $properties = & self::$publicPropertiesCache[get_class($object)];

        // Reflection is slow, we use get_object_vars to get the names as well
        if (!isset($properties)) {
            $extractorClosure = self::getExtractorClosure($object);
            $objectProperties = $extractorClosure($object);

            $properties = array_fill_keys(array_keys($objectProperties), true);
        }

        $validData = array_intersect_key($data, $properties);

        $hydratorClosure = self::getHydratorClosure($object);

        $hydratorClosure($object, $validData);
    }

    /**
     * {@inheritdoc}
     */
    public function extract($object)
    {
        $this->ensureObject($object);

        $extractorClosure = self::getExtractorClosure($object);

        return $extractorClosure($object);
    }

    /**
     * Returns a closure for hydration
     *
     * @param object $object
     *
     * @return \Closure
     */
    private static function getHydratorClosure($object)
    {
        if (!isset(self::$hydratorClosure)) {
            self::$hydratorClosure = function($object, array $data) {
                foreach ($data as $name => $value) {
                    $object->$name = $value;
                }
            };
        }

        return \Closure::bind(self::$hydratorClosure, null, get_class($object));
    }

    /**
     * Returns a closure for extraction
     *
     * @param object $object
     *
     * @return \Closure
     */
    private static function getExtractorClosure($object)
    {
        if (!isset(self::$extractorClosure)) {
            self::$extractorClosure = function($object) {
                return get_object_vars($object);
            };
        }

        return \Closure::bind(self::$extractorClosure, null, get_class($object));
    }
}
