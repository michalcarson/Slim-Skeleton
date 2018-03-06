<?php

namespace App\Services;

use App\Repositories\IndispensableRepository;
use Psr\Log\LoggerInterface;

class UsefulService
{
    /**
     * @var IndispensableRepository
     */
    private $repository;
    /**
     * @var LoggerInterface
     */
    private $log;

    public function __construct(
        IndispensableRepository $repository,
        LoggerInterface $log
    ) {
        $this->repository = $repository;
        $this->log = $log;
    }

    public function process()
    {
        $clients = $this->repository->selectMajorClients();

        foreach ($clients as $client) {
            if (isset($client->name)) {
                $this->log->info($client->name);
            }
        }

        return count($clients);
    }
}
