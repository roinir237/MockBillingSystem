<?php

namespace Curve\Billing;


class HourlyBill extends AbstractBill
{
    /**
     * @return int
     */
    public function getTotal()
    {
        $charges = $this->getCharges();
        $hoursPerDay = $charges['hoursPerDay'];
        $rate = $charges['hourlyRate'];

        $total = 0;
        foreach($hoursPerDay as $hours) {
            $dailyRate = $hours > 8 ? $rate * 1.5 : $rate;
            $total += $hours * $dailyRate;
        }

        return $total;
    }
}
