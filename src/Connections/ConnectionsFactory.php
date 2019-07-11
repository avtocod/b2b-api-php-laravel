<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Laravel\Connections;

use Closure;
use RuntimeException;
use Avtocod\B2BApi\Client;
use Avtocod\B2BApi\Settings;
use Avtocod\B2BApi\ClientInterface;
use Avtocod\B2BApi\Tokens\Auth\AuthToken;
use Illuminate\Contracts\Events\Dispatcher as EventsDispatcher;

class ConnectionsFactory implements ConnectionsFactoryInterface
{
    /**
     * @var Closure[]|array
     */
    protected $factories;

    /**
     * @var string|null
     */
    protected $default_name;

    /**
     * @var EventsDispatcher|null
     */
    protected $events;

    /**
     * Create a new ConnectionsFactory instance.
     *
     * @param array                 $settings     An array with connection settings
     *                                            (like `['name' => ['endpoint' => '...'], ...], ...`)
     * @param string|null           $default_name Default connection name
     * @param EventsDispatcher|null $events       Required for proxying client event into laravel events dispatcher
     */
    public function __construct(array $settings, ?string $default_name = null, ?EventsDispatcher $events = null)
    {
        foreach ($settings as $name => $connection_options) {
            $this->addFactory($name, $connection_options);
        }

        $this->default_name = $default_name;
        $this->events       = $events;
    }

    /**
     * {@inheritDoc}
     */
    public function addFactory(string $connection_name, array $settings = []): void
    {
        // Create connections factory
        $this->factories[$connection_name] = Closure::fromCallable(function () use ($settings): ClientInterface {
            $authorization = $settings['authorization'];

            $token = $authorization['token'] ?? AuthToken::generate(
                    $authorization['username'],
                    $authorization['password'],
                    $authorization['domain'],
                    $authorization['lifetime'] ?? 172800
                );

            return new Client(
                new Settings(
                    $token,
                    $settings['endpoint'] ?? null,
                    $settings['guzzle_options'] ?? null
                ),
                null,
                function ($event): void {
                    if ($this->events instanceof EventsDispatcher) {
                        $this->events->dispatch($event);
                    }
                }
            );
        });
    }

    /**
     * {@inheritDoc}
     */
    public function removeFactory(string $connection_name): void
    {
        unset($this->factories[$connection_name]);
    }

    /**
     * {@inheritDoc}
     */
    public function names(): array
    {
        return \array_keys($this->factories);
    }

    /**
     * {@inheritDoc}
     *
     * @throws RuntimeException
     */
    public function make(string $connection_name): ClientInterface
    {
        if (! $this->has($connection_name)) {
            throw new RuntimeException("Connection named [$connection_name] does not exists");
        }

        return $this->factories[$connection_name]();
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $connection_name): bool
    {
        return isset($this->factories[$connection_name]);
    }

    /**
     * {@inheritDoc}
     *
     * @throws RuntimeException
     */
    public function default(): ClientInterface
    {
        if ($this->default_name === null) {
            throw new RuntimeException('Default connection does not set');
        }

        return $this->make($this->default_name);
    }
}
