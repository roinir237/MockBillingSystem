<?php

namespace Curve\Entity;


class ClientRepository 
{
    /**
     * @param string $id
     * @return Client
     */
    public function findOneClientById($id)
    {
        return new Client();
    }
}
