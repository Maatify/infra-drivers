<?php

declare(strict_types=1);

use Maatify\InfraDrivers\Builder\MySQL\MySQLDBALDriverBuilder;
use Maatify\InfraDrivers\Config\MySQL\MySQLConfigDTO;

require __DIR__ . '/../vendor/autoload.php';

$config = new MySQLConfigDTO(
    dsn: 'mysql://user:password@localhost/test_db',
    username: 'user',
    password: 'password'
);

$builder = new MySQLDBALDriverBuilder();

/** @var \Doctrine\DBAL\Connection $connection */
$connection = $builder->build($config);

// Wiring verification only
echo "DBAL Connection created: " . get_class($connection) . PHP_EOL;
