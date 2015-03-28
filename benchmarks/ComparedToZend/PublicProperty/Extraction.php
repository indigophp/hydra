<?php

namespace Indigo\Hydra\Benchmark\ComparedToZend\PublicProperty;

use Athletic\AthleticEvent;
use Indigo\Hydra\Benchmark\ComparedToZend\Extraction as ParentBenchmark;
use Indigo\Hydra\Hydrator\PublicProperty;
use Zend\Stdlib\Hydrator\ObjectProperty as ZendObjectProperty;

class Extraction extends AthleticEvent
{
    use ParentBenchmark;

    public function classSetUp()
    {
        $this->hydra = new PublicProperty;
        $this->zend = new ZendObjectProperty;
    }
}

