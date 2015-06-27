<?php


namespace spec\Curve;

use Curve\Billing\AbstractBill;
use Curve\Entity\Client;
use Curve\Entity\ClientRepository;
use Curve\Service\BillingManager;
use Curve\Event\ClientBilledEvent;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class AppKernelSpec extends ObjectBehavior
{
    public function let(ClientRepository $clientRepository, BillingManager $billingManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->beConstructedWith($clientRepository, $billingManager, $eventDispatcher);
    }

    public function it_bills_the_client_and_dispatches_an_event(
        ClientRepository $clientRepository,
        BillingManager $billingManager,
        EventDispatcherInterface $eventDispatcher,
        Client $client,
        AbstractBill $bill
    ) {
        $clientRepository->findOneClientById(123)->shouldBeCalled()->willReturn($client);
        $billingManager->bill($client, 'someCharges')->shouldBeCalled()->willReturn($bill);
        $eventDispatcher->dispatch("billed_client", Argument::type(ClientBilledEvent::class))->shouldBeCalled();
        $this->start(array(
            'clientId' => 123,
            'charges' => 'someCharges'
        ))->shouldBe($bill);
    }
}
