<?php

namespace Indigo\Hydra\Benchmark\ObjectProperty;

use Athletic\AthleticEvent;
use Indigo\Hydra\Benchmark\Hydration as ParentBenchmark;
use Indigo\Hydra\Hydrator\ObjectProperty as HydraObjectProperty;
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
        $this->hydra = new HydraObjectProperty;
        $this->zend = new ZendObjectProperty;
    }
}

