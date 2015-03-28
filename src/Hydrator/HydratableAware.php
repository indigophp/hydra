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

/**
 * Firstly check if the object is Hydratable then fall back
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class HydratableAware extends Decorator
{
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
