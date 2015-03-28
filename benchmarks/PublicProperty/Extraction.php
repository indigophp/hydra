<?php

namespace Indigo\Hydra\Benchmark\PublicProperty;

use Athletic\AthleticEvent;
use Indigo\Hydra\Benchmark\Extraction as ParentBenchmark;
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

