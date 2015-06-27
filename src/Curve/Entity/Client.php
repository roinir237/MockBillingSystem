<?php

namespace Curve\Entity;


class Client 
{
    const PAYMENT_MAIL = "mail";

    const BILLING_HOURLY = "hourly";

    /**
     * @var int
     */
    private $id = 123;

    /**
     * @var string
     */
    private $paymentMethod = self::PAYMENT_MAIL;

    /**
     * @var string
     */
    private $billingType = self::BILLING_HOURLY;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     * @return $this
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * @return string
     */
    public function getBillingType()
    {
        return $this->billingType;
    }

    /**
     * @param string $billingType
     * @return $this
     */
    public function setBillingType($billingType)
    {
        $this->billingType = $billingType;

        return $this;
    }
}
