<?php

namespace spec\Indigo\Hydra\Hydrator;

use Indigo\Hydra\Stub\ShortExample;
use Indigo\Hydra\Stub\ShortExampleWithValues;
use Zend\Stdlib\Hydrator\HydratorInterface;
use PhpSpec\ObjectBehavior;

class ZendSpec extends ObjectBehavior
{
    function let(HydratorInterface $hydrator)
    {
        $this->beConstructedWith($hydrator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Hydra\Hydrator\Zend');
        $this->shouldHaveType('Indigo\Hydra\Hydrator\Base');
        $this->shouldImplement('Indigo\Hydra\Hydrator');
    }

    function it_hydrates_an_object_with_provided_data(HydratorInterface $hydrator)
    {
        $object = new ShortExample;
        $data = ['c' => 'c'];

        $hydrator->hydrate($data, $object)->shouldBeCalled();

        $this->hydrate($object, $data);
    }

    function it_throws_an_exception_when_non_object_is_passed_for_hydration()
    {
        $this->shouldThrow('InvalidArgumentException')->duringHydrate('object', []);
    }

    function it_extracts_values_from_an_object(HydratorInterface $hydrator)
    {
        $object = new ShortExampleWithValues;

        $hydrator->extract($object)->willReturn(['c' => 1]);

        $this->extract($object)->shouldReturn(['c' => 1]);
    }
}
