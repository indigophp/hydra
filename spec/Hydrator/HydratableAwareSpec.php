<?php

namespace spec\Indigo\Hydra\Hydrator;

use Indigo\Hydra\Hydratable;
use Indigo\Hydra\Hydrator;
use PhpSpec\ObjectBehavior;

class HydratableAwareSpec extends ObjectBehavior
{
    function let(Hydrator $hydrator)
    {
        $this->beConstructedWith($hydrator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Hydra\Hydrator\HydratableAware');
        $this->shouldHaveType('Indigo\Hydra\Hydrator\Decorator');
        $this->shouldImplement('Indigo\Hydra\Hydrator');
    }

    function it_does_not_call_the_hydrator_during_hydration(Hydrator $hydrator, Hydratable $object)
    {
        $hydrator->hydrate($object, [])->shouldNotBeCalled();
        $object->hydrate([])->shouldBeCalled();

        $this->hydrate($object, []);
    }

    function it_calls_the_hydrator_during_hydration(Hydrator $hydrator, \stdClass $object)
    {
        $hydrator->hydrate($object, [])->shouldBeCalled();

        $this->hydrate($object, []);
    }

    function it_does_not_call_the_hydrator_during_extraction(Hydrator $hydrator, Hydratable $object)
    {
        $hydrator->extract($object)->shouldNotBeCalled();
        $object->extract()->shouldBeCalled();

        $this->extract($object);
    }

    function it_calls_the_hydrator_during_extraction(Hydrator $hydrator, \stdClass $object)
    {
        $hydrator->extract($object)->shouldBeCalled();

        $this->extract($object);
    }
}
