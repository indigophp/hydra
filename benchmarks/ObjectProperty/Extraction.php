<?php

namespace Indigo\Hydra\Benchmark\ObjectProperty;

use Athletic\AthleticEvent;
use Indigo\Hydra\Benchmark\Extraction as ParentBenchmark;
use Indigo\Hydra\Hydrator\ObjectProperty as HydraObjectProperty;
use Zend\Stdlib\Hydrator\ObjectProperty as ZendObjectProperty;

class Extraction extends AthleticEvent
{
    use ParentBenchmark;

    public function classSetUp()
    {
        $this->hydra = new HydraObjectProperty;
        $this->zend = new ZendObjectProperty;
    }
}

