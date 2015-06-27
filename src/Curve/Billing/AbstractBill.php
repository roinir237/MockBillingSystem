<?php

namespace Curve\Billing;


abstract class AbstractBill
{
    /**
     * @var mixed $charges
     */
    private $charges;

    /**
     * @param $charges
     */
    public function __construct($charges)
    {
        $this->charges = $charges;
    }

    /**
     * @return mixed
     */
    public function getCharges()
    {
        return $this->charges;
    }

    /**
     * @return int
     */
    abstract public function getTotal();
}
