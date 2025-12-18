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

namespace Maatify\InfraDrivers\Config\Mongo;

use Maatify\InfraDrivers\Exception\InvalidDriverConfigException;

final readonly class MongoConfigDTO
{
    /**
     * @param array<string, mixed> $uriOptions
     * @param array<string, mixed> $driverOptions
     */
    public function __construct(
        public string $uri,
        public array $uriOptions = [],
        public array $driverOptions = []
    ) {
        if ($this->uri === '') {
            throw new InvalidDriverConfigException('MongoDB URI must not be empty.');
        }
    }
}