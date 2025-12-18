<?php

declare(strict_types=1);

use Maatify\InfraDrivers\Builder\Redis\RedisDriverBuilder;
use Maatify\InfraDrivers\Config\Redis\RedisConfigDTO;

require __DIR__ . '/../vendor/autoload.php';

$config = new RedisConfigDTO(
    host: 'localhost',
    port: 6379
);

$builder = new RedisDriverBuilder();

/** @var Redis $redis */
$redis = $builder->build($config);

// Wiring verification only
echo 'Redis instance created: ' . get_class($redis) . PHP_EOL;
