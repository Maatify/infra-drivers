<?php

/**
 * @copyright   ©2025 Maatify.dev
 * @Library     maatify/infra-drivers
 * @Project     maatify:infra-drivers
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2025-12-18 15:58
 * @see         https://www.maatify.dev Maatify.dev
 * @link        https://github.com/Maatify/infra-drivers view Project on GitHub
 * @note        Distributed in the hope that it will be useful - WITHOUT WARRANTY.
 */

declare(strict_types=1);

namespace Maatify\InfraDrivers\Tests\Builder\MySQL {

    use Maatify\InfraDrivers\Builder\MySQL\MySQLDBALDriverBuilder;
    use Maatify\InfraDrivers\Config\MySQL\MySQLConfigDTO;
    use Maatify\InfraDrivers\Exception\DriverBuildException;
    use PHPUnit\Framework\TestCase;

    class MySQLDBALDriverBuilderTest extends TestCase
    {
        public static bool $classExists = true;

        protected function setUp(): void
        {
            self::$classExists = true;
        }

        public function testBuildFailureWhenLibraryMissing(): void
        {
            self::$classExists = false;

            $config = new MySQLConfigDTO(
                dsn: 'sqlite::memory:',
                username: 'user',
                password: 'password'
            );

            $builder = new MySQLDBALDriverBuilder();

            $this->expectException(DriverBuildException::class);
            $this->expectExceptionMessage('Doctrine DBAL is not installed');

            $builder->build($config);
        }
    }
}

namespace Maatify\InfraDrivers\Builder\MySQL {
    if (! function_exists(__NAMESPACE__ . '\class_exists')) {
        function class_exists(string $class, bool $autoload = true): bool
        {
            if ($class === \Doctrine\DBAL\DriverManager::class) {
                return \Maatify\InfraDrivers\Tests\Builder\MySQL\MySQLDBALDriverBuilderTest::$classExists;
            }
            return \class_exists($class, $autoload);
        }
    }
}
