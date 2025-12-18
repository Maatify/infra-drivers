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
use Maatify\InfraDrivers\Exception\MissingExtensionException;
use MongoDB\Client;
use Throwable;

final class MongoDriverBuilder
{
    public function build(MongoConfigDTO $config): Client
    {
        if (!extension_loaded('mongodb')) {
            throw MissingExtensionException::forExtension('mongodb');
        }

        try {
            return new Client(
                $config->uri,
                $config->uriOptions,
                $config->driverOptions
            );
        } catch (Throwable $e) {
            throw DriverBuildException::fromThrowable('MongoDB', $e);
        }
    }
}
