<?php

namespace App\Repositories;

use PDO;

class IndispensableRepository
{
    /**
     * @var PDO
     */
    private $connection;

    public function __construct(
        PDO $connection
    ) {
        $this->connection = $connection;
    }

    public function selectMajorClients()
    {
        return $this->connection
            ->query('select * from clients')
            ->fetchAll();
    }
}
