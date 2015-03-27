<?php

namespace Indigo\Hydra\Benchmark\ObjectProperty;

use Athletic\AthleticEvent;
use Indigo\Hydra\Hydrator\ObjectProperty as HydraObjectProperty;
use Indigo\Hydra\Stub;
use Zend\Stdlib\Hydrator\ObjectProperty as ZendObjectProperty;

class Extraction extends AthleticEvent
{
    protected $hydraObjectProperty;
    protected $zendObjectProperty;

    protected $short;
    protected $shortWithValues;
    protected $long;
    protected $longWithValues;

    public function classSetUp()
    {
        $this->hydraObjectProperty = new HydraObjectProperty;
        $this->zendObjectProperty = new ZendObjectProperty;
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
        $this->hydraObjectProperty->extract($this->short);
    }

    /**
     * @iterations 1000
     */
    public function hydraShortWithValues()
    {
        $this->hydraObjectProperty->extract($this->shortWithValues);
    }

    /**
     * @iterations 1000
     */
    public function hydraLong()
    {
        $this->hydraObjectProperty->extract($this->long);
    }

    /**
     * @iterations 1000
     */
    public function hydraLongWithValues()
    {
        $this->hydraObjectProperty->extract($this->longWithValues);
    }

    /**
     * @iterations 1000
     */
    public function zendShort()
    {
        $this->zendObjectProperty->extract($this->short);
    }

    /**
     * @iterations 1000
     */
    public function zendShortWithValues()
    {
        $this->zendObjectProperty->extract($this->shortWithValues);
    }

    /**
     * @iterations 1000
     */
    public function zendLong()
    {
        $this->zendObjectProperty->extract($this->long);
    }

    /**
     * @iterations 1000
     */
    public function zendLongWithValues()
    {
        $this->zendObjectProperty->extract($this->longWithValues);
    }
}

