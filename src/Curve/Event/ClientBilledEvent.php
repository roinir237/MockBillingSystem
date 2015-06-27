<?php

namespace Curve\Event;


use Curve\Billing\AbstractBill;
use Curve\Entity\Client;
use Symfony\Component\EventDispatcher\Event;

class ClientBilledEvent extends Event
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var AbstractBill
     */
    private $bill;

    public function __construct(Client $client, AbstractBill $bill)
    {
        $this->client = $client;
        $this->bill = $bill;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return AbstractBill
     */
    public function getBill()
    {
        return $this->bill;
    }
}
