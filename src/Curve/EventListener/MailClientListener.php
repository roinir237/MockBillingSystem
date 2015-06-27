<?php

namespace Curve\EventListener;


use Curve\Entity\Client;
use Curve\Event\ClientBilledEvent;
use Curve\Service\Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MailClientListener implements EventSubscriberInterface
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return array(
          "billed_client" => "onClientBilled"
        );
    }

    /**
     * @param Mailer $mailer
     */
    function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param ClientBilledEvent $event
     */
    public function onClientBilled(ClientBilledEvent $event)
    {
        $client = $event->getClient();

        if ($client->getPaymentMethod() != Client::PAYMENT_MAIL) {
            return;
        }

        $this->mailer->notifyClient($client);
    }
}
