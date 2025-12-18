<?php

/**
 * @copyright   ©2025 Maatify.dev
 * @Library     maatify/infra-drivers
 * @Project     maatify:infra-drivers
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2025-12-18 15:58
 * @see         https://www.maatify.dev Maatify.dev
 * @link        https://github.com/Maatify/infra-drivers view Project on GitHub
 * @note        Distributed in the hope that it will be useful - WITHOUT WARRANTY.
 */

declare(strict_types=1);

namespace Maatify\InfraDrivers\Tests\Builder\MySQL;

use Doctrine\DBAL\Connection;
use Maatify\InfraDrivers\Builder\MySQL\MySQLDBALDriverBuilder;
use Maatify\InfraDrivers\Config\MySQL\MySQLConfigDTO;
use Maatify\InfraDrivers\Exception\DriverBuildException;
use PHPUnit\Framework\TestCase;

class MySQLDBALDriverBuilderTest extends TestCase
{
    public function testBuildSuccessWithSqlite(): void
    {
        // Using sqlite in memory as a substitute for valid MySQL connection to test DBAL creation
        $config = new MySQLConfigDTO(
            dsn: 'sqlite::memory:',
            username: 'user',
            password: 'password'
        );

        $builder = new MySQLDBALDriverBuilder();
        $connection = $builder->build($config);

        $this->assertInstanceOf(Connection::class, $connection);
    }

    public function testBuildFailure(): void
    {
        // DBAL DriverManager::getConnection validates parameters but might not connect immediately depending on config.
        // To force a failure, we can pass invalid options that DBAL rejects or rely on behavior.
        // However, standard DBAL often connects lazily.
        // If we provide a driver that doesn't exist, it throws.

        $config = new MySQLConfigDTO(
            dsn: 'invalid_driver://localhost',
            username: 'user',
            password: 'password'
        );

        $builder = new MySQLDBALDriverBuilder();

        $this->expectException(DriverBuildException::class);
        $this->expectExceptionMessage('Failed to build Doctrine DBAL MySQL connection');

        $builder->build($config);
    }
}
