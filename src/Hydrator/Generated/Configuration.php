<?php

/*
 * This file is part of the Indigo Hydra package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Hydra\Hydrator\Generated;

use CodeGenerationUtils\Autoloader\AutoloaderInterface;
use CodeGenerationUtils\Autoloader\Autoloader;
use CodeGenerationUtils\FileLocator\FileLocator;
use CodeGenerationUtils\GeneratorStrategy\FileWriterGeneratorStrategy;
use CodeGenerationUtils\GeneratorStrategy\GeneratorStrategyInterface;
use CodeGenerationUtils\Inflector\ClassNameInflectorInterface;
use CodeGenerationUtils\Inflector\ClassNameInflector;

/**
 * Hydrator Class configuration
 *
 * Heavily inspired by GeneratedHydrator
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Configuration
{
    const DEFAULT_NAMESPACE = 'HydraGeneratedClass';

    /**
     * @var string|null
     */
    protected $path;

    /**
     * @var string
     */
    protected $namespace = self::DEFAULT_NAMESPACE;

    /**
     * @var AutoloaderInterface|null
     */
    protected $autoloader;

    /**
     * @var GeneratorStrategyInterface|null
     */
    protected $generatorStrategy;

    /**
     * @var ClassNameInflectorInterface|null
     */
    protected $inflector;

    /**
     * Returns the path
     *
     * @return string
     */
    public function getPath()
    {
        if (!isset($this->path)) {
            $this->path = sys_get_temp_dir();
        }

        return $this->path;
    }

    /**
     * Sets the path
     *
     * @param string $path
     */
    public function setPath($path)
    {
        if (!is_string($path)) {
            throw new \InvalidArgumentException('Argument "$path" is expected to be string');
        }

        $this->path = $path;
    }

    /**
     * Returns the namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Sets the namespace
     *
     * @param string $namespace
     */
    public function setNamespace($namespace)
    {
        if (!is_string($namespace)) {
            throw new \InvalidArgumentException('Argument "$namespace" is expected to be string');
        }

        $this->namespace = $namespace;
    }

    /**
     * Returns the autoloader
     *
     * @return AutoloaderInterface
     */
    public function getAutoloader()
    {
        if (!isset($this->autoloader)) {
            $this->autoloader = new Autoloader(new FileLocator($this->getPath()), $this->getInflector());
        }

        return $this->autoloader;
    }

    /**
     * Sets the autoloader
     *
     * @param AutoloaderInterface $autoloader
     */
    public function setAutoloader(AutoloaderInterface $autoloader)
    {
        $this->autoloader = $autoloader;
    }

    /**
     * Returns the Generator Strategy
     *
     * @return GeneratorStrategyInterface
     */
    public function getGeneratorStrategy()
    {
        if (!isset($this->generatorStrategy)) {
            $this->generatorStrategy = new FileWriterGeneratorStrategy(new FileLocator($this->getPath()));
        }

        return $this->generatorStrategy;
    }

    /**
     * Sets the Generator Strategy
     *
     * @param GeneratorStrategyInterface $generatorStrategy
     */
    public function setGeneratorStrategy(GeneratorStrategyInterface $generatorStrategy)
    {
        $this->generatorStrategy = $generatorStrategy;
    }

    /**
     * Returns the inflector
     *
     * @return ClassNameInflectorInterface
     */
    public function getInflector()
    {
        if (!isset($this->inflector)) {
            $this->inflector = new ClassNameInflector($this->getNamespace());
        }

        return $this->inflector;
    }

    /**
     * Sets the inflector
     *
     * @param ClassNameInflectorInterface $inflector
     */
    public function setInflector(ClassNameInflectorInterface $inflector)
    {
        $this->inflector = $inflector;
    }
}
