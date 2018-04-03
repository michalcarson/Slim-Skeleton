<?php

use App\Repositories\IndispensableRepository;
use App\Services\UsefulService;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;

describe('Useful Service', function () {

    beforeEach(function () {
        $prophet = $this->getProphet();

        $this->repository = $prophet->prophesize(IndispensableRepository::class);
        $this->log = $prophet->prophesize(LoggerInterface::class);

        $this->service = new UsefulService($this->repository->reveal(), $this->log->reveal());
    });

    afterEach(function () {
        $this->getProphet()->checkPredictions();
    });

    context('process', function () {

        it('should do something useful', function () {

            $this->repository->selectMajorClients()->willReturn([
                (object) ['name' => 'a'],
                (object) ['name' => 'b'],
                (object) ['name' => 'c'],
                (object) ['name' => 'd'],
                (object) ['name' => 'e'],
            ]);
            $this->log->info('a')->shouldBeCalled();
            $this->log->info('b')->shouldBeCalled();
            $this->log->info('c')->shouldBeCalled();
            $this->log->info('d')->shouldBeCalled();
            $this->log->info('e')->shouldBeCalled();
            $this->log->error(Argument::any())->shouldNotBeCalled();

            $result = $this->service->process();

            expect($result)->to->equal(5);
            expect($result)->to->not->be->an('Object');
            expect($result > 3)->to->be->true;
            expect([1, 2, 3])->to->loosely->equal(['1', 2, '3']);
        });

    });

});
