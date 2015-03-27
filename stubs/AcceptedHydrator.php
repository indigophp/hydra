<?php

/*
 * This file is part of the Indigo Hydra package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Hydra\Stub;

use Indigo\Hydra\HydratorAcceptor;
use Indigo\Hydra\HydratorAware;

/**
 * Holds a hydrator object
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class AcceptedHydrator implements HydratorAware
{
    use HydratorAcceptor;
}
