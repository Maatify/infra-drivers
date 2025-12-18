<?php

declare(strict_types=1);

namespace Maatify\InfraDrivers\Tests\Config\Mongo;

use Maatify\InfraDrivers\Config\Mongo\MongoConfigDTO;
use PHPUnit\Framework\TestCase;

class MongoConfigDTOTest extends TestCase
{
    public function testValidConstruction(): void
    {
        $dto = new MongoConfigDTO('mongodb://localhost:27017', ['replicaSet' => 'rs0'], ['typeMap' => []]);
        $this->assertSame('mongodb://localhost:27017', $dto->uri);
        $this->assertSame(['replicaSet' => 'rs0'], $dto->uriOptions);
        $this->assertSame(['typeMap' => []], $dto->driverOptions);
    }

    public function testValidConstructionDefaults(): void
    {
        $dto = new MongoConfigDTO('mongodb://localhost:27017');
        $this->assertSame('mongodb://localhost:27017', $dto->uri);
        $this->assertSame([], $dto->uriOptions);
        $this->assertSame([], $dto->driverOptions);
    }

    public function testEmptyUriThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('MongoDB URI must not be empty.');
        new MongoConfigDTO('');
    }
}
