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
 * Extraction part of Hydrator
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Extraction
{
    /**
     * Extracts values from an object
     *
     * @param object $object
     *
     * @return array
     *
     * @throws \InvalidArgumentException If $object is not an object
     */
    public function extract($object);
}
