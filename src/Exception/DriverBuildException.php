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

namespace Maatify\InfraDrivers\Exception;

use RuntimeException;
use Throwable;

final class DriverBuildException extends RuntimeException
{
    public static function fromThrowable(
        string $driver,
        Throwable $previous
    ): self {
        return new self(
            sprintf('Failed to build %s driver.', $driver),
            0,
            $previous
        );
    }
}
