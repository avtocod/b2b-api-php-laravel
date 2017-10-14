<?php

namespace Avtocod\B2BApiLaravel\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;
use Avtocod\B2BApiLaravel\B2BApiServiceProvider;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Contracts\Config\Repository as ConfigRepository;

/**
 * Class AbstractUnitTestCase.
 */
abstract class AbstractUnitTestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../vendor/laravel/laravel/bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        // Register our service-provider manually
        $app->register(B2BApiServiceProvider::class);

        return $app;
    }

    /**
     * @param Application $app
     *
     * @return ConfigRepository
     */
    protected function getConfigRepository(Application $app)
    {
        return $app->make('config');
    }
}
