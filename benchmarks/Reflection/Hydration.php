<?php

namespace Indigo\Hydra\Benchmark\Reflection;

use Athletic\AthleticEvent;
use Indigo\Hydra\Benchmark\Hydration as ParentBenchmark;
use Indigo\Hydra\Hydrator\Reflection as HydraReflection;
use Zend\Stdlib\Hydrator\Reflection as ZendReflection;

class Hydration extends AthleticEvent
{
    use ParentBenchmark;

    protected $shortData = [
        'a' => 'a',
        'b' => 'b',
        'c' => 'c',
    ];

    protected $longData = [
        'a' => 'value1',
        'b' => 'value2',
        'c' => 'value3',
        'e' => 'value4',
        'f' => 'value5',
        'g' => 'value6',
        'h' => 'value7',
        'i' => 'value8',
        'j' => 'value9',
    ];

    public function classSetUp()
    {
        $this->hydra = new HydraReflection;
        $this->zend = new ZendReflection;
    }
}

