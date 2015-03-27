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
 * Use with HydratorAware
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait HydratorAcceptor
{
    /**
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * {@inheritdoc}
     */
    public function getHydrator()
    {
        return $this->hydrator;
    }

    /**
     * {@inheritdoc}
     */
    public function setHydrator(Hydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }
}
