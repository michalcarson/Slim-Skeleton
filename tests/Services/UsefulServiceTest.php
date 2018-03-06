<?php

namespace Tests\Services;

use App\Repositories\IndispensableRepository;
use App\Services\UsefulService;
use Mockery;
use Monolog\Logger;
use Tests\Functional\BaseTestCase;

class UsefulServiceTest extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->log = Mockery::mock(Logger::class);
        $this->container['logger'] = function ($c) { return $this->log; };

        $this->repo = Mockery::mock(IndispensableRepository::class);
        $this->container[IndispensableRepository::class] = function ($c) { return $this->repo; };

        $this->service = $this->container->get(UsefulService::class);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testProcess()
    {
        $this->log->shouldReceive('info')->atLeast()->once();

        $this->repo->shouldReceive('selectMajorClients')->once()->andReturn([
            (object) ['name' => 'a'],
            (object) ['name' => 'b'],
            (object) ['name' => 'c'],
            (object) ['name' => 'd'],
            (object) ['name' => 'e'],
        ]);

        $result = $this->service->process();

        $this->assertEquals(5, $result);
    }
}
