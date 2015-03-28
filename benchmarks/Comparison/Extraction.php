<?php

namespace Indigo\Hydra\Benchmark\Comparison;

use Athletic\AthleticEvent;

class Extraction extends AthleticEvent
{
    use Benchmark;

    /**
     * @iterations 1000
     */
    public function generatedHydratorShort()
    {
        $this->generatedHydrator->extract($this->short);
    }

    /**
     * @iterations 1000
     */
    public function generatedHydratorShortWithValues()
    {
        $this->generatedHydrator->extract($this->shortWithValues);
    }

    /**
     * @iterations 1000
     */
    public function generatedHydratorLong()
    {
        $this->generatedHydrator->extract($this->long);
    }

    /**
     * @iterations 1000
     */
    public function generatedHydratorLongWithValues()
    {
        $this->generatedHydrator->extract($this->longWithValues);
    }

    /**
     * @iterations 1000
     */
    public function objectPropertyShort()
    {
        $this->objectProperty->extract($this->short);
    }

    /**
     * @iterations 1000
     */
    public function objectPropertyShortWithValues()
    {
        $this->objectProperty->extract($this->shortWithValues);
    }

    /**
     * @iterations 1000
     */
    public function objectPropertyLong()
    {
        $this->objectProperty->extract($this->long);
    }

    /**
     * @iterations 1000
     */
    public function objectPropertyLongWithValues()
    {
        $this->objectProperty->extract($this->longWithValues);
    }

    /**
     * @iterations 1000
     */
    public function reflectionShort()
    {
        $this->reflection->extract($this->short);
    }

    /**
     * @iterations 1000
     */
    public function reflectionShortWithValues()
    {
        $this->reflection->extract($this->shortWithValues);
    }

    /**
     * @iterations 1000
     */
    public function reflectionLong()
    {
        $this->reflection->extract($this->long);
    }

    /**
     * @iterations 1000
     */
    public function reflectionLongWithValues()
    {
        $this->reflection->extract($this->longWithValues);
    }
}

