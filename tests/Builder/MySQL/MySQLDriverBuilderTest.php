<?php

/**
 * @copyright   ©2025 Maatify.dev
 * @Library     maatify/infra-drivers
 * @Project     maatify:infra-drivers
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2025-12-18 15:55
 * @see         https://www.maatify.dev Maatify.dev
 * @link        https://github.com/Maatify/infra-drivers view Project on GitHub
 * @note        Distributed in the hope that it will be useful - WITHOUT WARRANTY.
 */

declare(strict_types=1);

namespace Maatify\InfraDrivers\Tests\Builder\MySQL;

use Maatify\InfraDrivers\Builder\MySQL\MySQLDriverBuilder;
use Maatify\InfraDrivers\Config\MySQL\MySQLConfigDTO;
use Maatify\InfraDrivers\Exception\DriverBuildException;
use PHPUnit\Framework\TestCase;

class MySQLDriverBuilderTest extends TestCase
{
    public function testBuildFailureWhenDriverMissing(): void
    {
        $config = new MySQLConfigDTO(
            dsn: 'unknown:driver',
            username: 'user',
            password: 'password'
        );

        $builder = new MySQLDriverBuilder();

        $this->expectException(DriverBuildException::class);
        $this->expectExceptionMessage('Failed to build PDO MySQL driver');

        $builder->build($config);
    }
}
