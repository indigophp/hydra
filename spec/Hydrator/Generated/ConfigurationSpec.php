<?php

namespace spec\Indigo\Hydra\Hydrator\Generated;

use CodeGenerationUtils\Autoloader\AutoloaderInterface;
use CodeGenerationUtils\GeneratorStrategy\GeneratorStrategyInterface;
use CodeGenerationUtils\Inflector\ClassNameInflectorInterface;
use PhpSpec\ObjectBehavior;

class ConfigurationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Hydra\Hydrator\Generated\Configuration');
    }

    function it_has_a_path()
    {
        $this->setPath('/tmp');

        $this->getPath()->shouldReturn('/tmp');
    }

    function it_throws_an_exception_if_path_is_not_string()
    {
        $this->shouldThrow('InvalidArgumentException')->duringSetPath(null);
    }

    function it_has_a_namespace()
    {
        $this->setNamespace('Hydra');

        $this->getNamespace()->shouldReturn('Hydra');
    }

    function it_throws_an_exception_if_namespace_is_not_string()
    {
        $this->shouldThrow('InvalidArgumentException')->duringSetNamespace(null);
    }

    function it_has_an_autoloader(AutoloaderInterface $autoloader)
    {
        $this->setAutoloader($autoloader);

        $this->getAutoloader()->shouldReturn($autoloader);
    }

    function it_has_a_generator_strategy(GeneratorStrategyInterface $generatorStrategy)
    {
        $this->setGeneratorStrategy($generatorStrategy);

        $this->getGeneratorStrategy()->shouldReturn($generatorStrategy);
    }

    function it_has_an_inflector(ClassNameInflectorInterface $inflector)
    {
        $this->setInflector($inflector);

        $this->getInflector()->shouldReturn($inflector);
    }
}
