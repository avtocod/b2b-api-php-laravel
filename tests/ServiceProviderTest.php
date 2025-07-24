<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Laravel\Tests;

use Avtocod\B2BApi\Tokens\Auth\AuthToken;
use Avtocod\B2BApi\Laravel\ServiceProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use Avtocod\B2BApi\Laravel\Connections\ConnectionsFactory;
use Avtocod\B2BApi\Laravel\Connections\ConnectionsFactoryInterface;
use Avtocod\B2BApi\Laravel\ReportTypes\Repository as ReportTypesRepository;
use Avtocod\B2BApi\Laravel\ReportTypes\RepositoryInterface as ReportTypesRepositoryInterface;

#[CoversClass(ServiceProvider::class)]
class ServiceProviderTest extends AbstractTestCase
{
    /**
     * @return void
     */
    public function testGetConfigRootKeyName(): void
    {
        $this->assertSame('b2b-api-client', ServiceProvider::getConfigRootKeyName());
    }

    /**
     * @return void
     */
    public function testGetConfigPath(): void
    {
        $this->assertSame(
            \realpath(__DIR__ . '/../config/b2b-api-client.php'),
            \realpath(ServiceProvider::getConfigPath())
        );
    }

    /**
     * @return void
     */
    public function testRegistration(): void
    {
        $this->assertInstanceOf(ReportTypesRepository::class, $this->app->make(ReportTypesRepositoryInterface::class));
        $this->assertInstanceOf(ConnectionsFactory::class, $this->app->make(ConnectionsFactoryInterface::class));
    }

    /**
     * @return void
     */
    public function testReportTypesRepositoryInitialization(): void
    {
        /** @var ReportTypesRepository $report_types */
        $report_types  = $this->app->make(ReportTypesRepositoryInterface::class);
        $configuration = $this->config()->get(($root = ServiceProvider::getConfigRootKeyName()) . '.report_types');
        $default_name  = $this->config()->get("{$root}.default_report_type");

        $this->assertSame(\array_keys($configuration), $report_types->names());
        $this->assertSame($configuration[$default_name]['uid'], $report_types->default()->getUid());
    }

    /**
     * @return void
     */
    public function testConnectionsFactoryInitialization(): void
    {
        /** @var ConnectionsFactory $connections */
        $connections   = $this->app->make(ConnectionsFactoryInterface::class);
        $configuration = $this->config()->get(($root = ServiceProvider::getConfigRootKeyName()) . '.connections');
        $default_name  = $this->config()->get("{$root}.default_connection");

        $this->assertSame(\array_keys($configuration), $connections->names());

        $this->assertSame(
            $configuration[$default_name]['auth']['username'],
            AuthToken::parse($connections->default()->getSettings()->getAuthToken())->getUsername()
        );

        $this->assertSame(
            $configuration[$default_name]['auth']['domain'],
            AuthToken::parse($connections->default()->getSettings()->getAuthToken())->getDomainName()
        );
    }
}
