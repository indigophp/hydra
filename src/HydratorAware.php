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
 * Accepts a Hydrator dependency
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface HydratorAware
{
    /**
     * Returns the Hydrator
     *
     * @return Hydrator
     */
    public function getHydrator();

    /**
     * Sets the Hydrator
     *
     * @param Hydrator $hydrator
     */
    public function setHydrator(Hydrator $hydrator);
}
