<?php

/**
 * @copyright   ©2025 Maatify.dev
 * @Library     maatify/infra-drivers
 * @Project     maatify:infra-drivers
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2025-12-18 15:59
 * @see         https://www.maatify.dev Maatify.dev
 * @link        https://github.com/Maatify/infra-drivers view Project on GitHub
 * @note        Distributed in the hope that it will be useful - WITHOUT WARRANTY.
 */

declare(strict_types=1);

namespace Maatify\InfraDrivers\Builder\Redis;

use Maatify\InfraDrivers\Config\Redis\RedisConfigDTO;
use Maatify\InfraDrivers\Exception\DriverBuildException;
use Predis\Client as PredisClient;
use Throwable;

final class PredisDriverBuilder
{
    public function build(RedisConfigDTO $config): PredisClient
    {
        if (! class_exists(PredisClient::class)) {
            throw new DriverBuildException(
                'Predis library is not installed'
            );
        }

        try {
            return new PredisClient([
                'scheme'   => 'tcp',
                'host'     => $config->host,
                'port'     => $config->port,
                'password' => $config->password,
                'database' => $config->database,
                'timeout'  => $config->timeout,
            ]);
        } catch (Throwable $e) {
            throw new DriverBuildException(
                'Failed to build Predis client',
                previous: $e
            );
        }
    }
}
