<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Laravel;

use Illuminate\Contracts\Container\Container;
use Illuminate\Config\Repository as ConfigRepository;
use Avtocod\B2BApi\Laravel\Connections\ConnectionsFactory;
use Avtocod\B2BApi\Laravel\Connections\ConnectionsFactoryInterface;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Avtocod\B2BApi\Laravel\ReportTypes\Repository as ReportTypesRepository;
use Avtocod\B2BApi\Laravel\ReportTypes\RepositoryInterface as ReportTypesRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher as EventsDispatcher;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Get config root key name.
     *
     * @return string
     */
    public static function getConfigRootKeyName(): string
    {
        return \basename(static::getConfigPath(), '.php');
    }

    /**
     * Returns path to the configuration file.
     *
     * @return string
     */
    public static function getConfigPath(): string
    {
        return __DIR__ . '/../config/b2b-api-client.php';
    }

    /**
     * Register package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->initializeConfigs();

        $this->registerReportTypesRepository();
        $this->registerConnectionFactory();
    }

    /**
     * Register report types repository.
     *
     * @return void
     */
    protected function registerReportTypesRepository(): void
    {
        $this->app->singleton(
            ReportTypesRepositoryInterface::class,
            function (Container $container): ReportTypesRepositoryInterface {
                /** @var ConfigRepository $config */
                $config = $container->make(ConfigRepository::class);

                return new ReportTypesRepository(
                    (array) $config->get(static::getConfigRootKeyName() . '.report_types'),
                    $config->get(static::getConfigRootKeyName() . '.default_report_type')
                );
            }
        );
    }

    /**
     * Register B2B Api connections factory.
     *
     * @return void
     */
    protected function registerConnectionFactory(): void
    {
        $this->app->singleton(
            ConnectionsFactoryInterface::class,
            function (Container $container): ConnectionsFactoryInterface {
                /** @var ConfigRepository $config */
                $config = $container->make(ConfigRepository::class);

                return new ConnectionsFactory(
                    (array) $config->get(static::getConfigRootKeyName() . '.connections'),
                    $config->get(static::getConfigRootKeyName() . '.default_connection'),
                    $container->make(EventsDispatcher::class)
                );
            }
        );
    }

    /**
     * Initialize configs.
     *
     * @return void
     */
    protected function initializeConfigs(): void
    {
        $this->mergeConfigFrom(static::getConfigPath(), static::getConfigRootKeyName());

        $this->publishes([
            \realpath(static::getConfigPath()) => config_path(\basename(static::getConfigPath())),
        ], 'config');
    }
}
