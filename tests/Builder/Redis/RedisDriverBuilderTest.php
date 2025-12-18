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

namespace Maatify\InfraDrivers\Tests\Builder\Redis {

    use Maatify\InfraDrivers\Builder\Redis\RedisDriverBuilder;
    use Maatify\InfraDrivers\Config\Redis\RedisConfigDTO;
    use Maatify\InfraDrivers\Exception\DriverBuildException;
    use PHPUnit\Framework\TestCase;

    class RedisDriverBuilderTest extends TestCase
    {
        protected function setUp(): void
        {
            // Reset mock state if class exists (meaning we defined it)
            if (class_exists('Redis') && property_exists('Redis', 'connectReturn')) {
                \Redis::$connectReturn = true;
                \Redis::$authReturn = true;
                \Redis::$selectReturn = true;
                \Redis::$throwOnConnect = false;
            }

            RedisExtensionMock::$loaded = true;
        }

        public function testBuildSuccess(): void
        {
            if (extension_loaded('redis')) {
                $this->markTestSkipped('Cannot test Redis mock success when real Redis extension is loaded.');
            }

            $config = new RedisConfigDTO(
                host: '127.0.0.1',
                port: 6379,
                password: 'pass',
                database: 1
            );

            $builder = new RedisDriverBuilder();
            $redis = $builder->build($config);

            $this->assertInstanceOf('Redis', $redis);
        }

        public function testBuildFailureExtensionMissing(): void
        {
            RedisExtensionMock::$loaded = false;

            $config = new RedisConfigDTO(
                host: '127.0.0.1'
            );

            $builder = new RedisDriverBuilder();

            $this->expectException(DriverBuildException::class);
            $this->expectExceptionMessage('Redis extension is not loaded');

            $builder->build($config);
        }

        public function testBuildFailureConnectException(): void
        {
            if (extension_loaded('redis')) {
                $this->markTestSkipped('Cannot test Redis mock failure when real Redis extension is loaded.');
            }

            \Redis::$throwOnConnect = true;

            $config = new RedisConfigDTO(
                host: '127.0.0.1'
            );

            $builder = new RedisDriverBuilder();

            $this->expectException(DriverBuildException::class);
            $this->expectExceptionMessage('Failed to build Redis driver');

            $builder->build($config);
        }

        public function testBuildFailureAuthFailed(): void
        {
            if (extension_loaded('redis')) {
                $this->markTestSkipped('Cannot test Redis mock failure when real Redis extension is loaded.');
            }

            \Redis::$authReturn = false;

            $config = new RedisConfigDTO(
                host: '127.0.0.1',
                password: 'wrong_pass'
            );

            $builder = new RedisDriverBuilder();

            $this->expectException(DriverBuildException::class);
            $this->expectExceptionMessage('Redis authentication failed');

            $builder->build($config);
        }

        public function testBuildFailureSelectFailed(): void
        {
            if (extension_loaded('redis')) {
                $this->markTestSkipped('Cannot test Redis mock failure when real Redis extension is loaded.');
            }

            \Redis::$selectReturn = false;

            $config = new RedisConfigDTO(
                host: '127.0.0.1',
                database: 999
            );

            $builder = new RedisDriverBuilder();

            $this->expectException(DriverBuildException::class);
            $this->expectExceptionMessage('Redis database selection failed');

            $builder->build($config);
        }
    }

    class RedisExtensionMock
    {
        public static bool $loaded = true;
    }
}

// Namespace mocking for extension_loaded
namespace Maatify\InfraDrivers\Builder\Redis {

    function extension_loaded(string $extension): bool
    {
        if ($extension === 'redis') {
            return \Maatify\InfraDrivers\Tests\Builder\Redis\RedisExtensionMock::$loaded;
        }
        return \extension_loaded($extension);
    }
}

// Global namespace for Redis mock
namespace {
    if (! class_exists('Redis')) {
        class Redis
        {
            public static bool $connectReturn = true;
            public static bool $authReturn = true;
            public static bool $selectReturn = true;
            public static bool $throwOnConnect = false;

            public function connect(string $host, int $port, float $timeout): bool
            {
                if (self::$throwOnConnect) {
                    throw new \RedisException('Connection failed');
                }
                return self::$connectReturn;
            }

            public function auth(mixed $password): bool
            {
                return self::$authReturn;
            }

            public function select(int $db): bool
            {
                return self::$selectReturn;
            }
        }
    }
}
