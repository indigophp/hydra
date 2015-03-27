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
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Hydratable
{
    /**
     * Hydrates the with the provided data
     *
     * @param array  $data
     */
    public function hydrate(array $data);

    /**
     * Extracts values from the object
     *
     * @return array
     */
    public function extract();
}
