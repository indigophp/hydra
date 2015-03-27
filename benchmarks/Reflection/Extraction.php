<?php

namespace Indigo\Hydra\Benchmark\Reflection;

use Athletic\AthleticEvent;
use Indigo\Hydra\Hydrator\Reflection as HydraReflection;
use Indigo\Hydra\Stub;
use Zend\Stdlib\Hydrator\Reflection as ZendReflection;

class Extraction extends AthleticEvent
{
    protected $hydraReflection;
    protected $zendReflection;

    protected $short;
    protected $shortWithValues;
    protected $long;
    protected $longWithValues;

    public function classSetUp()
    {
        $this->hydraReflection = new HydraReflection;
        $this->zendReflection = new ZendReflection;
    }

    public function setUp()
    {
        $this->short = new Stub\ShortExample;
        $this->shortWithValues = new Stub\ShortExampleWithValues;
        $this->long = new Stub\LongExample;
        $this->longWithValues = new Stub\LongExampleWithValues;
    }

    /**
     * @iterations 1000
     */
    public function hydraShort()
    {
        $this->hydraReflection->extract($this->short);
    }

    /**
     * @iterations 1000
     */
    public function hydraShortWithValues()
    {
        $this->hydraReflection->extract($this->shortWithValues);
    }

    /**
     * @iterations 1000
     */
    public function hydraLong()
    {
        $this->hydraReflection->extract($this->long);
    }

    /**
     * @iterations 1000
     */
    public function hydraLongWithValues()
    {
        $this->hydraReflection->extract($this->longWithValues);
    }

    /**
     * @iterations 1000
     */
    public function zendShort()
    {
        $this->zendReflection->extract($this->short);
    }

    /**
     * @iterations 1000
     */
    public function zendShortWithValues()
    {
        $this->zendReflection->extract($this->shortWithValues);
    }

    /**
     * @iterations 1000
     */
    public function zendLong()
    {
        $this->zendReflection->extract($this->long);
    }

    /**
     * @iterations 1000
     */
    public function zendLongWithValues()
    {
        $this->zendReflection->extract($this->longWithValues);
    }
}

