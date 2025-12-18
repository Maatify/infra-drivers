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

namespace Maatify\InfraDrivers\Tests\Builder\Mongo {

    use Maatify\InfraDrivers\Builder\Mongo\MongoDriverBuilder;
    use Maatify\InfraDrivers\Config\Mongo\MongoConfigDTO;
    use Maatify\InfraDrivers\Exception\MissingExtensionException;
    use PHPUnit\Framework\TestCase;

    class MongoDriverBuilderTest extends TestCase
    {
        public static bool $extensionLoaded = true;

        protected function setUp(): void
        {
            self::$extensionLoaded = true;
        }

        public function testBuildFailureWhenExtensionMissing(): void
        {
            self::$extensionLoaded = false;

            $config = new MongoConfigDTO(
                uri: 'mongodb://localhost:27017'
            );

            $builder = new MongoDriverBuilder();

            $this->expectException(MissingExtensionException::class);
            $this->expectExceptionMessage('Required PHP extension "mongodb" is not loaded.');

            $builder->build($config);
        }
    }
}

namespace Maatify\InfraDrivers\Builder\Mongo {
    if (! function_exists(__NAMESPACE__ . '\extension_loaded')) {
        function extension_loaded(string $extension): bool
        {
            if ($extension === 'mongodb') {
                return \Maatify\InfraDrivers\Tests\Builder\Mongo\MongoDriverBuilderTest::$extensionLoaded;
            }
            return \extension_loaded($extension);
        }
    }
}
