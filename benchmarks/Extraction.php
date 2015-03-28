<?php

namespace Indigo\Hydra\Benchmark;

trait Extraction
{
    use Benchmark;

    /**
     * @iterations 1000
     */
    public function hydraShort()
    {
        $this->hydra->extract($this->short);
    }

    /**
     * @iterations 1000
     */
    public function hydraShortWithValues()
    {
        $this->hydra->extract($this->shortWithValues);
    }

    /**
     * @iterations 1000
     */
    public function hydraLong()
    {
        $this->hydra->extract($this->long);
    }

    /**
     * @iterations 1000
     */
    public function hydraLongWithValues()
    {
        $this->hydra->extract($this->longWithValues);
    }

    /**
     * @iterations 1000
     */
    public function zendShort()
    {
        $this->zend->extract($this->short);
    }

    /**
     * @iterations 1000
     */
    public function zendShortWithValues()
    {
        $this->zend->extract($this->shortWithValues);
    }

    /**
     * @iterations 1000
     */
    public function zendLong()
    {
        $this->zend->extract($this->long);
    }

    /**
     * @iterations 1000
     */
    public function zendLongWithValues()
    {
        $this->zend->extract($this->longWithValues);
    }
}

