<?php

namespace Indigo\Hydra\Benchmark\Reflection;

use Athletic\AthleticEvent;
use Indigo\Hydra\Benchmark\Extraction as ParentBenchmark;
use Indigo\Hydra\Hydrator\Reflection as HydraReflection;
use Zend\Stdlib\Hydrator\Reflection as ZendReflection;

class Extraction extends AthleticEvent
{
    use ParentBenchmark;

    public function classSetUp()
    {
        $this->hydra = new HydraReflection;
        $this->zend = new ZendReflection;
    }
}

