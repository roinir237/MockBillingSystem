<?php


namespace spec\Curve\Service;

use Curve\Billing\HourlyBill;
use Curve\Entity\Client;
use Curve\Exception\BillingMethodNotSupported;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BillingManagerSpec extends ObjectBehavior
{
    public function it_bills_a_client_based_on_his_billing_type(Client $client)
    {
        $this->addBillingMethod('hourly', HourlyBill::class);
        $client->getBillingType()->willReturn('hourly');

        $this->bill($client, "charges")->shouldImplement(AbstractBill::class);
    }

    public function it_throws_an_exception_if_the_clients_billing_type_is_unsupported(Client $client)
    {
        $client->getBillingType()->willReturn('hourly');
        $this->shouldThrow(BillingMethodNotSupported::class)->duringBill($client, "charges");
    }
}
