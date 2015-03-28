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

use Indigo\Hydra\Hydrator;

/**
 * Wrapper using GeneratedHydrator created by Marco Pivetta (@Ocramius)
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Generated extends Base
{
    /**
     * @var array
     */
    private static $hydratorCache;

    /**
     * @var Generated\Generator
     */
    protected $generator;

    /**
     * @param Generated\Generator|null $generator
     */
    public function __construct(Generated\Generator $generator = null)
    {
        if (!isset($generator)) {
            $generator = new Generated\Generator;
        }

        $this->generator = $generator;
    }

    /**
     * {@inheritdoc}
     */
    public function hydrate($object, array $data)
    {
        $this->ensureObject($object);

        $hydrator = $this->getHydrator($object);

        $hydrator->hydrate($object, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function extract($object)
    {
        $this->ensureObject($object);

        $hydrator = $this->getHydrator($object);

        return $hydrator->extract($object);
    }

    /**
     * Returns a GeneratedHydrator for the object
     *
     * @param object $object
     *
     * @return Hydrator
     */
    private function getHydrator($object)
    {
        $class = get_class($object);

        if (!isset(self::$hydratorCache[$class])) {
            $hydratorClass = $this->generator->getHydratorClass($class);

            self::$hydratorCache[$class] = new $hydratorClass;
        }

        return self::$hydratorCache[$class];
    }
}
