<?php

namespace Avtocod\B2BApi\Laravel\Connections;

use Exception;
use Avtocod\B2BApi\ClientInterface;

/**
 * @see \Avtocod\B2BApi\Laravel\Connections\ConnectionsFactory
 */
interface ConnectionsFactoryInterface
{
    /**
     * Get all available connection names.
     *
     * @return array|string[]
     */
    public function names(): array;

    /**
     * Add connection factory.
     *
     * IMPORTANT: Passed settings must follows settings format!
     *
     * @param string $connection_name
     * @param array  $settings
     *
     * @return void
     */
    public function addFactory(string $connection_name, array $settings = []): void;

    /**
     * Remove connection factory.
     *
     * @param string $connection_name
     *
     * @return void
     */
    public function removeFactory(string $connection_name): void;

    /**
     * Determine if connection exists or not.
     *
     * @param string $connection_name
     *
     * @return bool
     */
    public function has(string $connection_name): bool;

    /**
     * Make connection instance.
     *
     * @param string $connection_name Connection name
     *
     * @throws Exception
     *
     * @return ClientInterface
     */
    public function make(string $connection_name): ClientInterface;

    /**
     * Make default connection.
     *
     * @throws Exception
     *
     * @return ClientInterface
     */
    public function default(): ClientInterface;
}
