<?php

namespace Indigo\Hydra\Benchmark\ComparedToZend\PublicProperty;

use Athletic\AthleticEvent;
use Indigo\Hydra\Benchmark\ComparedToZend\Hydration as ParentBenchmark;
use Indigo\Hydra\Hydrator\PublicProperty;
use Zend\Stdlib\Hydrator\ObjectProperty as ZendObjectProperty;

class Hydration extends AthleticEvent
{
    use ParentBenchmark;

    protected $shortData = [
        'c' => 'c',
    ];

    protected $longData = [
        'c' => 'value1',
        'e' => 'value2',
        'f' => 'value3',
        'g' => 'value4',
        'h' => 'value5',
        'i' => 'value6',
        'j' => 'value7',
    ];

    public function classSetUp()
    {
        $this->hydra = new PublicProperty;
        $this->zend = new ZendObjectProperty;
    }
}

