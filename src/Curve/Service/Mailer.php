<?php

namespace Curve\Service;


use Curve\Entity\Client;

class Mailer
{
    /**
     * @param Client $client
     */
    public function notifyClient(Client $client)
    {
        echo "Notified client by email\n";
    }
}
