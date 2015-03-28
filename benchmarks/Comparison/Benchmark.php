<?php

namespace Indigo\Hydra\Benchmark\Comparison;

use Indigo\Hydra\Hydrator;
use Indigo\Hydra\Stub;

trait Benchmark
{
    protected $generatedHydrator;
    protected $objectProperty;
    protected $reflection;

    protected $short;
    protected $shortWithValues;
    protected $long;
    protected $longWithValues;

    public function classSetUp()
    {
        $this->generatedHydrator = new Hydrator\GeneratedHydrator;
        $this->objectProperty = new Hydrator\ObjectProperty;
        $this->reflection = new Hydrator\Reflection;
    }

    public function setUp()
    {
        $this->short = new Stub\ShortExample;
        $this->shortWithValues = new Stub\ShortExampleWithValues;
        $this->long = new Stub\LongExample;
        $this->longWithValues = new Stub\LongExampleWithValues;
    }
}

