<?php

namespace Curve;

use Curve\Entity\ClientRepository;
use Curve\Event\ClientBilledEvent;
use Curve\Service\BillingManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class AppKernel
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var BillingManager
     */
    private $billingManager;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(
        ClientRepository $clientRepository,
        BillingManager $billingManager,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->clientRepository = $clientRepository;
        $this->billingManager = $billingManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param $billingDetails
     * @return Billing\AbstractBill
     * @throws Exception\BillingMethodNotSupported
     */
    public function start($billingDetails)
    {
        $client = $this->clientRepository->findOneClientById($billingDetails['clientId']);
        $bill = $this->billingManager->bill($client, $billingDetails['charges']);

        $this->eventDispatcher->dispatch("billed_client", new ClientBilledEvent($client, $bill));

        return $bill;
    }
}
