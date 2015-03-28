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
 * Decorator functions
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class Decorator extends Base
{
    /**
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * @param Hydrator $hydrator
     */
    public function __construct(Hydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }
}
