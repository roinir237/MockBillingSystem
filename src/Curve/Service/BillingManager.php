<?php

namespace Curve\Service;


use Curve\Billing\AbstractBill;
use Curve\Entity\Client;
use Curve\Exception\BillingMethodNotSupported;

class BillingManager
{
    /**
     * @var string[]
     */
    private $billingMethods = array();

    /**
     * @param string $key
     * @param string $class
     */
    public function addBillingMethod($key, $class)
    {
        $this->billingMethods[$key] = $class;
    }

    /**
     * @param Client $client
     * @param mixed $charges
     * @return AbstractBill
     * @throws BillingMethodNotSupported
     */
    public function bill(Client $client, $charges)
    {
        if (array_key_exists($client->getBillingType(), $this->billingMethods)) {
            $class = $this->billingMethods[$client->getBillingType()];

            return new $class($charges);
        }

        throw new BillingMethodNotSupported("Billing method " . $client->getBillingType() . " is not supported.");
    }
}
