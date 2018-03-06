<?php

namespace App\Services;

use App\Repositories\IndispensableRepository;
use Monolog\Logger;

class UsefulService
{
    /**
     * @var IndispensableRepository
     */
    private $repository;
    /**
     * @var Logger
     */
    private $log;

    public function __construct(
        IndispensableRepository $repository,
        Logger $log
    ) {
        $this->repository = $repository;
        $this->log = $log;
    }

    public function process()
    {
        $clients = $this->repository->selectMajorClients();

        foreach ($clients as $client) {
            $this->log->info($client->name);
        }

        return count($clients);
    }
}
