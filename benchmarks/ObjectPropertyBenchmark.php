<?php

namespace Indigo\Hydra\Benchmark;

use Athletic\AthleticEvent;
use Indigo\Hydra\Hydrator\ObjectProperty as HydraObjectProperty;
use Indigo\Hydra\Stub;
use Zend\Stdlib\Hydrator\ObjectProperty as ZendObjectProperty;

class ObjectPropertyBenchmark extends AthleticEvent
{
    protected $hydraObjectProperty;
    protected $zendObjectProperty;

    protected $short;
    protected $shortWithValues;
    protected $long;
    protected $longWithValues;

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
        $this->hydraObjectProperty->hydrate($this->short, $this->shortData);
    }

    /**
     * @iterations 1000
     */
    public function hydraShortWithValues()
    {
        $this->hydraObjectProperty->hydrate($this->shortWithValues, $this->shortData);
    }

    /**
     * @iterations 1000
     */
    public function hydraLong()
    {
        $this->hydraObjectProperty->hydrate($this->long, $this->longData);
    }

    /**
     * @iterations 1000
     */
    public function hydraLongWithValues()
    {
        $this->hydraObjectProperty->hydrate($this->longWithValues, $this->longData);
    }

    /**
     * @iterations 1000
     */
    public function zendShort()
    {
        $this->zendObjectProperty->hydrate($this->shortData, $this->short);
    }

    /**
     * @iterations 1000
     */
    public function zendShortWithValues()
    {
        $this->zendObjectProperty->hydrate($this->shortData, $this->shortWithValues);
    }

    /**
     * @iterations 1000
     */
    public function zendLong()
    {
        $this->zendObjectProperty->hydrate($this->longData, $this->long);
    }

    /**
     * @iterations 1000
     */
    public function zendLongWithValues()
    {
        $this->zendObjectProperty->hydrate($this->longData, $this->longWithValues);
    }
}

