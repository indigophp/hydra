<?php

/*
 * This file is part of the Indigo Hydra package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Hydra;

/**
 * Hydration part of Hydrator
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Hydration
{
    /**
     * Hydrates an object with the provided data
     *
     * @param object $object
     * @param array  $data
     *
     * @throws \InvalidArgumentException If $object is not an object
     */
    public function hydrate($object, array $data);
}
