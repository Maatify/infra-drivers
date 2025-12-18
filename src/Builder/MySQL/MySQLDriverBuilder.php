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

namespace Maatify\InfraDrivers\Builder\MySQL;

use Maatify\InfraDrivers\Config\MySQL\MySQLConfigDTO;
use Maatify\InfraDrivers\Exception\DriverBuildException;
use PDO;
use PDOException;

final class MySQLDriverBuilder
{
    public function build(MySQLConfigDTO $config): PDO
    {
        try {
            return new PDO(
                $config->dsn,
                $config->username,
                $config->password,
                $config->options
            );
        } catch (PDOException $e) {
            throw new DriverBuildException(
                'Failed to build PDO MySQL driver',
                previous: $e
            );
        }
    }
}
