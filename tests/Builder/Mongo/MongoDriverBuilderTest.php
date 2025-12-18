<?php

/**
 * @copyright   ©2025 Maatify.dev
 * @Library     maatify/infra-drivers
 * @Project     maatify:infra-drivers
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2025-12-18 15:56
 * @see         https://www.maatify.dev Maatify.dev
 * @link        https://github.com/Maatify/infra-drivers view Project on GitHub
 * @note        Distributed in the hope that it will be useful - WITHOUT WARRANTY.
 */

declare(strict_types=1);

namespace Maatify\InfraDrivers\Tests\Builder\Mongo;

use Maatify\InfraDrivers\Builder\Mongo\MongoDriverBuilder;
use Maatify\InfraDrivers\Config\Mongo\MongoConfigDTO;
use Maatify\InfraDrivers\Exception\DriverBuildException;
use MongoDB\Client;
use PHPUnit\Framework\TestCase;

class MongoDriverBuilderTest extends TestCase
{
    public function testBuildSuccess(): void
    {
        $config = new MongoConfigDTO(
            uri: 'mongodb://localhost:27017'
        );

        $builder = new MongoDriverBuilder();
        $client = $builder->build($config);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testBuildFailureWithInvalidUri(): void
    {
        $config = new MongoConfigDTO(
            uri: 'mongodb://' // Invalid URI (empty host list) usually throws InvalidArgumentException
        );

        $builder = new MongoDriverBuilder();

        $this->expectException(DriverBuildException::class);
        $this->expectExceptionMessage('Failed to build MongoDB client');

        $builder->build($config);
    }
}

// Namespace mocking for extension_loaded
namespace Maatify\InfraDrivers\Builder\Mongo;

function extension_loaded(string $extension): bool
{
    if ($extension === 'mongodb') {
        return \Maatify\InfraDrivers\Tests\Builder\Mongo\MongoExtensionMock::$loaded;
    }
    return \extension_loaded($extension);
}

namespace Maatify\InfraDrivers\Tests\Builder\Mongo;

class MongoExtensionMock
{
    public static bool $loaded = true;
}

// Add a test for missing extension
class MongoDriverBuilderExtensionMissingTest extends TestCase
{
    protected function tearDown(): void
    {
        MongoExtensionMock::$loaded = true;
    }

    public function testBuildFailureWhenExtensionMissing(): void
    {
        MongoExtensionMock::$loaded = false;

        $config = new MongoConfigDTO(
            uri: 'mongodb://localhost:27017'
        );

        $builder = new MongoDriverBuilder();

        $this->expectException(DriverBuildException::class);
        $this->expectExceptionMessage('MongoDB extension is not loaded');

        $builder->build($config);
    }
}
