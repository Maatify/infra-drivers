<?php

/**
 * @copyright   ©2025 Maatify.dev
 * @Library     maatify/infra-drivers
 * @Project     maatify:infra-drivers
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2025-12-18 14:09
 * @see         https://www.maatify.dev Maatify.dev
 * @link        https://github.com/Maatify/infra-drivers view Project on GitHub
 * @note        Distributed in the hope that it will be useful - WITHOUT WARRANTY.
 */

declare(strict_types=1);

namespace Maatify\InfraDrivers\Config\MySQL;

use Maatify\InfraDrivers\Exception\InvalidDriverConfigException;

final readonly class MySQLConfigDTO
{
    /**
     * @param array<string, mixed> $options
     */
    public function __construct(
        public string $dsn,
        public string $username,
        public string $password,
        public array $options = []
    ) {
        if ($this->dsn === '') {
            throw new InvalidDriverConfigException('MySQL DSN must not be empty.');
        }

        if ($this->username === '') {
            throw new InvalidDriverConfigException('MySQL username must not be empty.');
        }
    }
}
