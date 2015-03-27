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

use GeneratedHydrator\Configuration;

/**
 * Wrapper using GeneratedHydrator created by Marco Pivetta (@Ocramius)
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class GeneratedHydrator extends Base
{
    /**
     * @var array
     */
    private static $hydratorCache;

    /**
     * {@inheritdoc}
     */
    public function hydrate($object, array $data)
    {
        $this->ensureObject($object);

        $hydrator = self::getHydrator($object);

        $hydrator->hydrate($data, $object);
    }

    /**
     * {@inheritdoc}
     */
    public function extract($object)
    {
        $this->ensureObject($object);

        $hydrator = self::getHydrator($object);

        return $hydrator->extract($object);
    }

    /**
     * Returns a GeneratedHydrator for the object
     *
     * @param object $object
     *
     * @return GeneratedHydrator
     */
    private static function getHydrator($object)
    {
        $class = get_class($object);

        if (!isset(self::$hydratorCache[$class])) {
            $configuration = new Configuration($class);
            $hydratorClass = $configuration->createFactory()->getHydratorClass();

            self::$hydratorCache[$class] = new $hydratorClass;
        }

        return self::$hydratorCache[$class];
    }
}
