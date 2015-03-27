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
 * Basic Hydrator functions
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class Base implements Hydrator
{
    /**
     * Ensures the passed object is object
     *
     * @param object $object
     *
     * @throws \InvalidArgumentException If $object is not an object
     */
    protected function ensureObject($object)
    {
        if (!is_object($object)) {
            throw new \InvalidArgumentException(sprintf('Parameter $object is expected to be object, %s given', gettype($object)));
        }
    }
}
