<?php

namespace Indigo\Hydra\Benchmark\Reflection;

use Athletic\AthleticEvent;
use Indigo\Hydra\Hydrator\Reflection as HydraReflection;
use Indigo\Hydra\Stub;
use Zend\Stdlib\Hydrator\Reflection as ZendReflection;

class Hydration extends AthleticEvent
{
    protected $hydraReflection;
    protected $zendReflection;

    protected $short;
    protected $shortWithValues;
    protected $long;
    protected $longWithValues;

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
        $this->hydraReflection->hydrate($this->short, $this->shortData);
    }

    /**
     * @iterations 1000
     */
    public function hydraShortWithValues()
    {
        $this->hydraReflection->hydrate($this->shortWithValues, $this->shortData);
    }

    /**
     * @iterations 1000
     */
    public function hydraLong()
    {
        $this->hydraReflection->hydrate($this->long, $this->longData);
    }

    /**
     * @iterations 1000
     */
    public function hydraLongWithValues()
    {
        $this->hydraReflection->hydrate($this->longWithValues, $this->longData);
    }

    /**
     * @iterations 1000
     */
    public function zendShort()
    {
        $this->zendReflection->hydrate($this->shortData, $this->short);
    }

    /**
     * @iterations 1000
     */
    public function zendShortWithValues()
    {
        $this->zendReflection->hydrate($this->shortData, $this->shortWithValues);
    }

    /**
     * @iterations 1000
     */
    public function zendLong()
    {
        $this->zendReflection->hydrate($this->longData, $this->long);
    }

    /**
     * @iterations 1000
     */
    public function zendLongWithValues()
    {
        $this->zendReflection->hydrate($this->longData, $this->longWithValues);
    }
}

