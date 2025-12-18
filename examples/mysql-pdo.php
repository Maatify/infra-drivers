<?php

declare(strict_types=1);

use Maatify\InfraDrivers\Builder\MySQL\MySQLDriverBuilder;
use Maatify\InfraDrivers\Config\MySQL\MySQLConfigDTO;

require __DIR__ . '/../vendor/autoload.php';

$config = new MySQLConfigDTO(
    dsn: 'mysql:host=localhost;dbname=test_db;charset=utf8mb4',
    username: 'user',
    password: 'password'
);

$builder = new MySQLDriverBuilder();

/** @var PDO $pdo */
$pdo = $builder->build($config);

// Wiring verification only
echo 'PDO instance created: ' . get_class($pdo) . PHP_EOL;
