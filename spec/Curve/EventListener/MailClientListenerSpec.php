<?php


namespace spec\Curve\EventListener;

use Curve\Entity\Client;
use Curve\Event\ClientBilledEvent;
use Curve\Service\Mailer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MailClientListenerSpec extends ObjectBehavior
{

    public function let(Mailer $mailer)
    {
        $this->beConstructedWith($mailer);
    }

    public function it_sends_the_client_an_email_if_his_payment_method_is_mail(Mailer $mailer, Client $client, ClientBilledEvent $event)
    {
        $event->getClient()->willReturn($client);
        $client->getPaymentMethod()->shouldBeCalled()->willReturn(Client::PAYMENT_MAIL);
        $mailer->notifyClient($client)->shouldBeCalled();

        $this->onClientBilled($event);
    }

    public function it_ignores_the_event_if_the_clients_payment_method_is_not_mail(Mailer $mailer, Client $client, ClientBilledEvent $event)
    {
        $event->getClient()->willReturn($client);
        $client->getPaymentMethod()->shouldBeCalled()->willReturn('other');
        $mailer->notifyClient($client)->shouldNotBeCalled();

        $this->onClientBilled($event);
    }
}
