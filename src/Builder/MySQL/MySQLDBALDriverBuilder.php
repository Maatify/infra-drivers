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

namespace Maatify\InfraDrivers\Builder\MySQL;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception as DBALException;
use Maatify\InfraDrivers\Config\MySQL\MySQLConfigDTO;
use Maatify\InfraDrivers\Exception\DriverBuildException;

final class MySQLDBALDriverBuilder
{
    public function build(MySQLConfigDTO $config): Connection
    {
        if (! class_exists(DriverManager::class)) {
            throw new DriverBuildException(
                'Doctrine DBAL is not installed'
            );
        }

        try {
            return DriverManager::getConnection([
                'url'      => $config->dsn,
                'user'     => $config->username,
                'password' => $config->password,
                'options'  => $config->options,
            ]);
        } catch (DBALException $e) {
            throw new DriverBuildException(
                'Failed to build Doctrine DBAL MySQL connection',
                previous: $e
            );
        }
    }
}
