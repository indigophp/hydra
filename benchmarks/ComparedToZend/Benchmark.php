<?php

namespace Indigo\Hydra\Benchmark\ComparedToZend;

use Indigo\Hydra\Stub;

trait Benchmark
{
    protected $hydra;
    protected $zend;

    protected $short;
    protected $shortWithValues;
    protected $long;
    protected $longWithValues;

    public function setUp()
    {
        $this->short = new Stub\ShortExample;
        $this->shortWithValues = new Stub\ShortExampleWithValues;
        $this->long = new Stub\LongExample;
        $this->longWithValues = new Stub\LongExampleWithValues;
    }
}

