<?php

namespace Indigo\Hydra\Benchmark\ComparedToZend;

trait Hydration
{
    use Benchmark;

    /**
     * @iterations 1000
     */
    public function hydraShort()
    {
        $this->hydra->hydrate($this->short, $this->shortData);
    }

    /**
     * @iterations 1000
     */
    public function hydraShortWithValues()
    {
        $this->hydra->hydrate($this->shortWithValues, $this->shortData);
    }

    /**
     * @iterations 1000
     */
    public function hydraLong()
    {
        $this->hydra->hydrate($this->long, $this->longData);
    }

    /**
     * @iterations 1000
     */
    public function hydraLongWithValues()
    {
        $this->hydra->hydrate($this->longWithValues, $this->longData);
    }

    /**
     * @iterations 1000
     */
    public function zendShort()
    {
        $this->zend->hydrate($this->shortData, $this->short);
    }

    /**
     * @iterations 1000
     */
    public function zendShortWithValues()
    {
        $this->zend->hydrate($this->shortData, $this->shortWithValues);
    }

    /**
     * @iterations 1000
     */
    public function zendLong()
    {
        $this->zend->hydrate($this->longData, $this->long);
    }

    /**
     * @iterations 1000
     */
    public function zendLongWithValues()
    {
        $this->zend->hydrate($this->longData, $this->longWithValues);
    }
}

