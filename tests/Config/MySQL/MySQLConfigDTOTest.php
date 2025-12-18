<?php

declare(strict_types=1);

namespace Maatify\InfraDrivers\Tests\Config\MySQL;

use Maatify\InfraDrivers\Config\MySQL\MySQLConfigDTO;
use PHPUnit\Framework\TestCase;

class MySQLConfigDTOTest extends TestCase
{
    public function testValidConstruction(): void
    {
        $dto = new MySQLConfigDTO('mysql:host=localhost;dbname=test', 'user', 'pass', ['opt' => 'val']);
        $this->assertSame('mysql:host=localhost;dbname=test', $dto->dsn);
        $this->assertSame('user', $dto->username);
        $this->assertSame('pass', $dto->password);
        $this->assertSame(['opt' => 'val'], $dto->options);
    }

    public function testEmptyDsnThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('MySQL DSN must not be empty.');
        new MySQLConfigDTO('', 'user', 'pass');
    }

    public function testEmptyUsernameThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('MySQL username must not be empty.');
        new MySQLConfigDTO('dsn', '', 'pass');
    }
}
