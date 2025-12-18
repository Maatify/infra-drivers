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

namespace Maatify\InfraDrivers\Builder\Redis;

use Maatify\InfraDrivers\Config\Redis\RedisConfigDTO;
use Maatify\InfraDrivers\Exception\DriverBuildException;
use Redis;
use RedisException;

final class RedisDriverBuilder
{
    public function build(RedisConfigDTO $config): Redis
    {
        if (! extension_loaded('redis')) {
            throw new DriverBuildException('Redis extension is not loaded');
        }

        $redis = new Redis();

        try {
            $redis->connect(
                $config->host,
                $config->port,
                $config->timeout
            );

            if ($config->password !== null) {
                if ($redis->auth($config->password) !== true) {
                    throw new DriverBuildException('Redis authentication failed');
                }
            }

            if ($config->database !== 0) {
                if ($redis->select($config->database) !== true) {
                    throw new DriverBuildException('Redis database selection failed');
                }
            }

            return $redis;
        } catch (RedisException $e) {
            throw new DriverBuildException(
                'Failed to build Redis driver',
                previous: $e
            );
        }
    }
}
