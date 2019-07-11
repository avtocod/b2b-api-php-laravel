<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Laravel\Connections;

use Closure;
use RuntimeException;
use Avtocod\B2BApi\Client;
use Avtocod\B2BApi\Settings;
use Avtocod\B2BApi\ClientInterface;
use Avtocod\B2BApi\WithSettingsInterface;
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
    protected $dispatcher;

    /**
     * Create a new ConnectionsFactory instance.
     *
     * @param array                 $settings     An array with connection settings
     *                                            (like `['name' => ['base_uri' => '...'], ...]`)
     * @param string|null           $default_name Default connection name
     * @param EventsDispatcher|null $dispatcher   Required for proxying client event into laravel events dispatcher
     */
    public function __construct(array $settings, ?string $default_name = null, ?EventsDispatcher $dispatcher = null)
    {
        foreach ($settings as $name => $connection_options) {
            $this->addFactory($name, $connection_options);
        }

        $this->default_name = $default_name;
        $this->dispatcher   = $dispatcher;
    }

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
    public function addFactory(string $connection_name, array $settings = []): void
    {
        // Create connections factory
        $this->factories[$connection_name] = Closure::fromCallable(function () use ($settings): ClientInterface {
            $authorization = $settings['auth'];

            $token = $authorization['token'] ?? AuthToken::generate(
                    $authorization['username'],
                    $authorization['password'],
                    $authorization['domain'],
                    $authorization['lifetime'] ?? 3600
                );

            return new Client(
                new Settings(
                    $token,
                    $settings['base_uri'] ?? null,
                    $settings['guzzle_options'] ?? null
                ),
                null,
                function ($event): void {
                    if ($this->dispatcher instanceof EventsDispatcher) {
                        $this->dispatcher->dispatch($event);
                    }
                }
            );
        });
    }

    /**
     * Remove connection factory.
     *
     * @param string $connection_name
     *
     * @return void
     */
    public function removeFactory(string $connection_name): void
    {
        unset($this->factories[$connection_name]);
    }

    /**
     * {@inheritdoc}
     */
    public function names(): array
    {
        return \array_keys($this->factories);
    }

    /**
     * {@inheritdoc}
     *
     * @throws RuntimeException
     *
     * @return ClientInterface|WithSettingsInterface
     */
    public function make(string $connection_name): ClientInterface
    {
        if (! $this->has($connection_name)) {
            throw new RuntimeException("Connection named [$connection_name] does not exists");
        }

        return $this->factories[$connection_name]();
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $connection_name): bool
    {
        return isset($this->factories[$connection_name]);
    }

    /**
     * {@inheritdoc}
     *
     * @throws RuntimeException
     *
     * @return ClientInterface|WithSettingsInterface
     */
    public function default(): ClientInterface
    {
        if ($this->default_name === null) {
            throw new RuntimeException('Default connection does not set');
        }

        return $this->make($this->default_name);
    }
}
