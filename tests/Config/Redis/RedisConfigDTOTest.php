<?php

declare(strict_types=1);

namespace Maatify\InfraDrivers\Tests\Config\Redis;

use Maatify\InfraDrivers\Config\Redis\RedisConfigDTO;
use PHPUnit\Framework\TestCase;

class RedisConfigDTOTest extends TestCase
{
    public function testValidConstructionFullArgs(): void
    {
        $dto = new RedisConfigDTO('localhost', 1234, 'secret', 1, 5.0);
        $this->assertSame('localhost', $dto->host);
        $this->assertSame(1234, $dto->port);
        $this->assertSame('secret', $dto->password);
        $this->assertSame(1, $dto->database);
        $this->assertSame(5.0, $dto->timeout);
    }

    public function testValidConstructionDefaults(): void
    {
        $dto = new RedisConfigDTO('localhost');
        $this->assertSame('localhost', $dto->host);
        $this->assertSame(6379, $dto->port);
        $this->assertNull($dto->password);
        $this->assertSame(0, $dto->database);
        $this->assertSame(0.0, $dto->timeout);
    }

    public function testEmptyHostThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Redis host must not be empty.');
        new RedisConfigDTO('');
    }

    public function testInvalidPortThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Redis port must be greater than zero.');
        new RedisConfigDTO('localhost', 0);
    }

    public function testNegativePortThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Redis port must be greater than zero.');
        new RedisConfigDTO('localhost', -1);
    }

    public function testNegativeDatabaseThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Redis database index must be zero or positive.');
        new RedisConfigDTO('localhost', 6379, null, -1);
    }

    public function testNegativeTimeoutThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Redis timeout must be zero or positive.');
        new RedisConfigDTO('localhost', 6379, null, 0, -0.1);
    }
}
