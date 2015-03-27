<?php

namespace spec\Indigo\Hydra\Stub;

use Indigo\Hydra\Hydrator;
use PhpSpec\ObjectBehavior;

class AcceptedHydratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Hydra\Stub\AcceptedHydrator');
        $this->shouldImplement('Indigo\Hydra\HydratorAware');
    }

    function it_has_a_hydrator(Hydrator $hydrator)
    {
        $this->setHydrator($hydrator);

        $this->getHydrator()->shouldReturn($hydrator);
    }
}
