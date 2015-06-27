<?php


namespace spec\Curve\Billing;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HourlyBillSpec extends ObjectBehavior
{

    public function it_calculates_the_total_bill_based_on_the_charges()
    {
        $this->beConstructedWith(array(
            'hoursPerDay' => [1, 2, 3, 4, 10],
            'hourlyRate' => 10
        ));

        $this->getTotal()->shouldBeLike(250);
    }
}
