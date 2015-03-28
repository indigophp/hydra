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

use Indigo\Hydra\Hydratable;
use Indigo\Hydra\Hydrator;

/**
 * Firstly check if the object is Hydratable then fall back
 *
 * Further object check can be done by the delegated hydrator,
 * thus extending Base is not needed
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class HydratableAware implements Hydrator
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

    /**
     * {@inheritdoc}
     */
    public function hydrate($object, array $data)
    {
        if ($object instanceof Hydratable) {
            $object->hydrate($data);

            return;
        }

        $this->hydrator->hydrate($object, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function extract($object)
    {
        if ($object instanceof Hydratable) {
            return $object->extract();
        }

        return $this->hydrator->extract($object);
    }
}
