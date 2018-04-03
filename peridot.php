<?php

use Evenement\EventEmitterInterface;
use Peridot\Configuration;
use Peridot\Plugin\Prophecy\ProphecyPlugin;

return function (EventEmitterInterface $emitter) {
    $emitter->on('peridot.configure', function (Configuration $configuration) {
        $configuration->setPath('specs');
    });

    new ProphecyPlugin($emitter);
};
