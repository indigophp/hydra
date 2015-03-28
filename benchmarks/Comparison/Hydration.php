<?php

namespace Indigo\Hydra\Benchmark\Comparison;

use Athletic\AthleticEvent;

class Hydration extends AthleticEvent
{
    use Benchmark;

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

    /**
     * @iterations 1000
     */
    public function generatedShort()
    {
        $this->generated->hydrate($this->short, $this->shortData);
    }

    /**
     * @iterations 1000
     */
    public function generatedShortWithValues()
    {
        $this->generated->hydrate($this->shortWithValues, $this->shortData);
    }

    /**
     * @iterations 1000
     */
    public function generatedLong()
    {
        $this->generated->hydrate($this->long, $this->longData);
    }

    /**
     * @iterations 1000
     */
    public function generatedLongWithValues()
    {
        $this->generated->hydrate($this->longWithValues, $this->longData);
    }

    /**
     * @iterations 1000
     */
    public function generatedHydratorShort()
    {
        $this->generatedHydrator->hydrate($this->short, $this->shortData);
    }

    /**
     * @iterations 1000
     */
    public function generatedHydratorShortWithValues()
    {
        $this->generatedHydrator->hydrate($this->shortWithValues, $this->shortData);
    }

    /**
     * @iterations 1000
     */
    public function generatedHydratorLong()
    {
        $this->generatedHydrator->hydrate($this->long, $this->longData);
    }

    /**
     * @iterations 1000
     */
    public function generatedHydratorLongWithValues()
    {
        $this->generatedHydrator->hydrate($this->longWithValues, $this->longData);
    }

    /**
     * @iterations 1000
     */
    public function objectPropertyShort()
    {
        $this->objectProperty->hydrate($this->short, $this->shortData);
    }

    /**
     * @iterations 1000
     */
    public function objectPropertyShortWithValues()
    {
        $this->objectProperty->hydrate($this->shortWithValues, $this->shortData);
    }

    /**
     * @iterations 1000
     */
    public function objectPropertyLong()
    {
        $this->objectProperty->hydrate($this->long, $this->longData);
    }

    /**
     * @iterations 1000
     */
    public function objectPropertyLongWithValues()
    {
        $this->objectProperty->hydrate($this->longWithValues, $this->longData);
    }

    /**
     * @iterations 1000
     */
    public function reflectionShort()
    {
        $this->reflection->hydrate($this->short, $this->shortData);
    }

    /**
     * @iterations 1000
     */
    public function reflectionShortWithValues()
    {
        $this->reflection->hydrate($this->shortWithValues, $this->shortData);
    }

    /**
     * @iterations 1000
     */
    public function reflectionLong()
    {
        $this->reflection->hydrate($this->long, $this->longData);
    }

    /**
     * @iterations 1000
     */
    public function reflectionLongWithValues()
    {
        $this->reflection->hydrate($this->longWithValues, $this->longData);
    }
}

