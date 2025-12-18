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

namespace Maatify\InfraDrivers\Tests\Builder\Redis;

use Maatify\InfraDrivers\Builder\Redis\PredisDriverBuilder;
use Maatify\InfraDrivers\Config\Redis\RedisConfigDTO;
use Maatify\InfraDrivers\Exception\DriverBuildException;
use PHPUnit\Framework\TestCase;
use Predis\Client as PredisClient;

class PredisDriverBuilderTest extends TestCase
{
    public function testBuildSuccess(): void
    {
        $config = new RedisConfigDTO(
            host: '127.0.0.1',
            port: 6379,
            password: null,
            database: 0
        );

        $builder = new PredisDriverBuilder();
        $client = $builder->build($config);

        $this->assertInstanceOf(PredisClient::class, $client);
    }
}
