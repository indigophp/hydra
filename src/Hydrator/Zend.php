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

use Zend\Stdlib\Hydrator\HydratorInterface;

/**
 * Zend Hydrator wrapper
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Zend extends Base
{
    /**
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     * @param HydratorInterface $hydrator
     */
    public function __construct(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * {@inheritdoc}
     */
    public function hydrate($object, array $data)
    {
        $this->ensureObject($object);

        $this->hydrator->hydrate($data, $object);
    }

    /**
     * {@inheritdoc}
     */
    public function extract($object)
    {
        $this->ensureObject($object);

        return $this->hydrator->extract($object);
    }
}
