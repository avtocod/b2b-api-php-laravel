<?php

namespace Avtocod\B2BApi\Laravel\Connections;

use Exception;
use Avtocod\B2BApi\ClientInterface;
use Avtocod\B2BApi\WithSettingsInterface;

/**
 * @see \Avtocod\B2BApi\Laravel\Connections\ConnectionsFactory
 */
interface ConnectionsFactoryInterface
{
    /**
     * Get all available connection names.
     *
     * @return array<string>
     */
    public function names(): array;

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
     * @throws Exception When connection name does not exists
     *
     * @return ClientInterface
     */
    public function make(string $connection_name): ClientInterface;

    /**
     * Make default connection.
     *
     * @throws Exception When default connection does not set
     *
     * @return ClientInterface
     */
    public function default(): ClientInterface;
}
