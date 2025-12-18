<?php

/**
 * @copyright   ©2025 Maatify.dev
 * @Library     maatify/infra-drivers
 * @Project     maatify:infra-drivers
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2025-12-18 15:59
 * @see         https://www.maatify.dev Maatify.dev
 * @link        https://github.com/Maatify/infra-drivers view Project on GitHub
 * @note        Distributed in the hope that it will be useful - WITHOUT WARRANTY.
 */

declare(strict_types=1);

namespace Maatify\InfraDrivers\Tests\Builder\Redis {

    use Maatify\InfraDrivers\Builder\Redis\PredisDriverBuilder;
    use Maatify\InfraDrivers\Config\Redis\RedisConfigDTO;
    use Maatify\InfraDrivers\Exception\DriverBuildException;
    use PHPUnit\Framework\TestCase;

    class PredisDriverBuilderTest extends TestCase
    {
        public static bool $classExists = true;

        protected function setUp(): void
        {
            self::$classExists = true;
        }

        public function testBuildFailureWhenLibraryMissing(): void
        {
            self::$classExists = false;

            $config = new RedisConfigDTO(
                host: '127.0.0.1'
            );

            $builder = new PredisDriverBuilder();

            $this->expectException(DriverBuildException::class);
            $this->expectExceptionMessage('Predis library is not installed');

            $builder->build($config);
        }
    }
}

namespace Maatify\InfraDrivers\Builder\Redis {
    if (! function_exists(__NAMESPACE__ . '\class_exists')) {
        function class_exists(string $class, bool $autoload = true): bool
        {
            if ($class === \Predis\Client::class) {
                return \Maatify\InfraDrivers\Tests\Builder\Redis\PredisDriverBuilderTest::$classExists;
            }
            return \class_exists($class, $autoload);
        }
    }
}
