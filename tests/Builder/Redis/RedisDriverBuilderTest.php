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
    use Maatify\InfraDrivers\Exception\MissingExtensionException;
    use PHPUnit\Framework\TestCase;

    class RedisDriverBuilderTest extends TestCase
    {
        public static bool $extensionLoaded = true;

        protected function setUp(): void
        {
            self::$extensionLoaded = true;
        }

        public function testBuildFailureWhenExtensionMissing(): void
        {
            self::$extensionLoaded = false;

            $config = new RedisConfigDTO(
                host: '127.0.0.1'
            );

            $builder = new RedisDriverBuilder();

            $this->expectException(MissingExtensionException::class);
            $this->expectExceptionMessage('Required PHP extension "redis" is not loaded.');

            $builder->build($config);
        }
    }
}

namespace Maatify\InfraDrivers\Builder\Redis {
    if (! function_exists(__NAMESPACE__ . '\extension_loaded')) {
        function extension_loaded(string $extension): bool
        {
            if ($extension === 'redis') {
                return \Maatify\InfraDrivers\Tests\Builder\Redis\RedisDriverBuilderTest::$extensionLoaded;
            }
            return \extension_loaded($extension);
        }
    }
}
