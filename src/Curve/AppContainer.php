<?php

use Curve\Service\BillingManager;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

return array(
    EventDispatcherInterface::class => DI\object(EventDispatcher::class)
        ->method('addSubscriber', \DI\get('Curve\EventListener\MailClientListener')),

    BillingManager::class => DI\object(BillingManager::class)
        ->method('addBillingMethod', "hourly", 'Curve\Billing\HourlyBill')
);
