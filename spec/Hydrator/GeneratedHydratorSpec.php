<?php

namespace spec\Indigo\Hydra\Hydrator;

use Indigo\Hydra\Stub\ShortExample;
use Indigo\Hydra\Stub\ShortExampleWithValues;
use Indigo\Hydra\Stub\ZeroExample;
use PhpSpec\ObjectBehavior;

class GeneratedHydratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Hydra\Hydrator\GeneratedHydrator');
        $this->shouldHaveType('Indigo\Hydra\Hydrator\Base');
        $this->shouldImplement('Indigo\Hydra\Hydrator');
    }

    function it_hydrates_an_object_with_provided_data()
    {
        $object = new ShortExample;
        $data = [
            'a' => 'a',
            'b' => 'b',
            'c' => 'c'
        ];

        $this->hydrate($object, $data);
    }

    function it_throws_an_exception_when_non_object_is_passed_for_hydration()
    {
        $this->shouldThrow('InvalidArgumentException')->duringHydrate('object', []);
    }

    function it_extracts_values_from_an_object()
    {
        $object = new ShortExampleWithValues;

        $this->extract($object)->shouldReturn([
            'b' => null,
            'c' => 1,
            'a' => 'a',
        ]);
    }

    function it_extracts_values_from_an_empty_object()
    {
        $object = new ZeroExample;

        $this->extract($object)->shouldReturn([]);
    }
}
