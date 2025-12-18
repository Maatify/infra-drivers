<?php

/**
 * @copyright   ©2025 Maatify.dev
 * @Library     maatify/infra-drivers
 * @Project     maatify:infra-drivers
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2025-12-18 14:11
 * @see         https://www.maatify.dev Maatify.dev
 * @link        https://github.com/Maatify/infra-drivers view Project on GitHub
 * @note        Distributed in the hope that it will be useful - WITHOUT WARRANTY.
 */

declare(strict_types=1);

namespace Maatify\InfraDrivers\Config\Redis;

use Maatify\InfraDrivers\Exception\InvalidDriverConfigException;

final readonly class RedisConfigDTO
{
    public function __construct(
        public string $host,
        public int $port = 6379,
        public ?string $password = null,
        public int $database = 0,
        public float $timeout = 0.0
    ) {
        if ($this->host === '') {
            throw new InvalidDriverConfigException('Redis host must not be empty.');
        }

        if ($this->port <= 0) {
            throw new InvalidDriverConfigException('Redis port must be greater than zero.');
        }

        if ($this->database < 0) {
            throw new InvalidDriverConfigException(
                'Redis database index must be zero or positive.'
            );
        }

        if ($this->timeout < 0.0) {
            throw new InvalidDriverConfigException(
                'Redis timeout must be zero or positive.'
            );
        }
    }
}
