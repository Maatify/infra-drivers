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

namespace Maatify\InfraDrivers\Builder\Mongo;

use Maatify\InfraDrivers\Config\Mongo\MongoConfigDTO;
use Maatify\InfraDrivers\Exception\DriverBuildException;
use MongoDB\Client;
use Throwable;

final class MongoDriverBuilder
{
    public function build(MongoConfigDTO $config): Client
    {
        if (! extension_loaded('mongodb')) {
            throw new DriverBuildException('MongoDB extension is not loaded');
        }

        try {
            return new Client(
                $config->uri,
                $config->uriOptions,
                $config->driverOptions
            );
        } catch (Throwable $e) {
            throw new DriverBuildException(
                'Failed to build MongoDB client',
                previous: $e
            );
        }
    }
}
