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
use Maatify\InfraDrivers\Exception\MissingExtensionException;
use Redis;
use RedisException;

final class RedisDriverBuilder
{
    public function build(RedisConfigDTO $config): Redis
    {
        if (!extension_loaded('redis')) {
            throw MissingExtensionException::forExtension('redis');
        }

        $redis = new Redis();

        try {
            $redis->connect(
                $config->host,
                $config->port,
                $config->timeout
            );

            if ($config->password !== null) {
                $redis->auth($config->password);
            }

            if ($config->database !== 0) {
                $redis->select($config->database);
            }

            return $redis;
        } catch (RedisException $e) {
            throw DriverBuildException::fromThrowable('Redis', $e);
        }
    }
}
