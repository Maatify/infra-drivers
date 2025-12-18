<?php

declare(strict_types=1);

use Maatify\InfraDrivers\Builder\Redis\PredisDriverBuilder;
use Maatify\InfraDrivers\Config\Redis\RedisConfigDTO;

require __DIR__ . '/../vendor/autoload.php';

$config = new RedisConfigDTO(
    host: 'localhost',
    port: 6379
);

$builder = new PredisDriverBuilder();

/** @var \Predis\Client $client */
$client = $builder->build($config);

// Wiring verification only
echo "Predis Client created: " . get_class($client) . PHP_EOL;
