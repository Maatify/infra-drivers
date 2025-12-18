<?php

declare(strict_types=1);

use Maatify\InfraDrivers\Builder\Mongo\MongoDriverBuilder;
use Maatify\InfraDrivers\Config\Mongo\MongoConfigDTO;

require __DIR__ . '/../vendor/autoload.php';

$config = new MongoConfigDTO(
    uri: 'mongodb://localhost:27017'
);

$builder = new MongoDriverBuilder();

/** @var \MongoDB\Client $client */
$client = $builder->build($config);

// Wiring verification only
echo 'MongoDB Client created: ' . get_class($client) . PHP_EOL;
