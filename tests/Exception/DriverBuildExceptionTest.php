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

namespace Maatify\InfraDrivers\Tests\Exception;

use Maatify\InfraDrivers\Exception\DriverBuildException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class DriverBuildExceptionTest extends TestCase
{
    public function testIsRuntimeException(): void
    {
        $exception = new DriverBuildException('Test');
        $this->assertInstanceOf(RuntimeException::class, $exception);
    }
}
