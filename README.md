<p align="center">
  <img src="https://laravel.com/assets/img/components/logo-laravel.svg" alt="Laravel" width="240" />
</p>

## [B2B Api client][b2b_api_client_laravel] integration for Laravel applications

[![Version][badge_packagist_version]][link_packagist]
[![Version][badge_php_version]][link_packagist]
[![Build Status][badge_build_status]][link_build_status]
[![Coverage][badge_coverage]][link_coverage]
[![Downloads count][badge_downloads_count]][link_packagist]
[![License][badge_license]][link_license]

## Install

Require this package with composer using the following command:

```shell
$ composer require avtocod/b2b-api-php-laravel "^4.0"
```

> Installed `composer` is required ([how to install composer][getcomposer]).

> You need to fix the major version of package.

After that you should "publish" package configuration file using next command:

```shell
$ php ./artisan vendor:publish --provider='Avtocod\B2BApi\Laravel\ServiceProvider'
```

And modify `./config/b2b-api-client.php`.

## Usage

This package provides:

- Connections factory _(`ConnectionsFactoryInterface`)_ - B2B API client factory _(configuration for it loads from published configuration file)_;
- Report types repository _(`RepositoryInterface`)_ - single entry-point for getting access to the report types information;

In any part of your application you can resolve their implementations. For example, in artisan command:

```php
<?php

declare(strict_types = 1);

namespace App\Console\Commands;

use Avtocod\B2BApi\Params\UserReportMakeParams;
use Avtocod\B2BApi\Laravel\ReportTypes\RepositoryInterface;
use Avtocod\B2BApi\Laravel\Connections\ConnectionsFactoryInterface;

class SomeCommand extends \Illuminate\Console\Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'some:command';

    /**
     * Execute the console command.
     *
     * @param RepositoryInterface         $report_types
     * @param ConnectionsFactoryInterface $connections
     *
     * @return void
     */
    public function handle(RepositoryInterface $report_types, ConnectionsFactoryInterface $connections): void
    {
        $uid = $report_types->default()->getUid(); // Get default report type UID

        // Create a parameter object for a request to make a report
        $report_make_params = UserReportMakeParams($uid, 'VIN', 'Z94CB41AAGR323020')

        $report_uid = $connections->default()
            ->userReportMake($report_make_params)
            ->first()
            ->getReportUid();

        $this->comment("Report UID: {$report_uid}");
    }
}
```

### Events

Also this package proxying B2B Api client events into Laravel events dispatcher. So, feel free for writing own listeners like:

```php
<?php

declare(strict_types = 1);

namespace App\Listeners;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;
use Avtocod\B2BApi\Events\RequestFailedEvent;

class LogFailedB2bApiRequestListener
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Create a new listener instance.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param RequestFailedEvent $event
     *
     * @return void
     */
    public function handle(RequestFailedEvent $event): void
    {
        $this->logger->warning('Request to the Avtocod B2B API Failed', [
            'request_uri'   => $event->getRequest()->getUri(),
            'response_code' => $event->getResponse() instanceof ResponseInterface
                ? $event->getResponse()->getStatusCode()
                : null
        ]);
    }
}
```

> More information about events listeners can be [found here][link_laravel_events]

### Testing

For package testing we use `phpunit` framework and `docker-ce` + `docker-compose` as develop environment. So, just write into your terminal after repository cloning:

```shell
$ make build
$ make latest # or 'make lowest'
$ make test
```

## Changes log

[![Release date][badge_release_date]][link_releases]
[![Commits since latest release][badge_commits_since_release]][link_commits]

Changes log can be [found here][link_changes_log].

## Support

[![Issues][badge_issues]][link_issues]
[![Issues][badge_pulls]][link_pulls]

If you will find any package errors, please, [make an issue][link_create_issue] in current repository.

## License

This is open-sourced software licensed under the [MIT License][link_license].

[badge_packagist_version]:https://img.shields.io/packagist/v/avtocod/b2b-api-php-laravel.svg?maxAge=180
[badge_php_version]:https://img.shields.io/packagist/php-v/avtocod/b2b-api-php-laravel.svg?longCache=true
[badge_build_status]:https://img.shields.io/github/actions/workflow/status/avtocod/b2b-api-php-laravel/tests.yml
[badge_coverage]:https://img.shields.io/codecov/c/github/avtocod/b2b-api-php-laravel/master.svg?maxAge=60
[badge_downloads_count]:https://img.shields.io/packagist/dt/avtocod/b2b-api-php-laravel.svg?maxAge=180
[badge_license]:https://img.shields.io/packagist/l/avtocod/b2b-api-php-laravel.svg?longCache=true
[badge_release_date]:https://img.shields.io/github/release-date/avtocod/b2b-api-php-laravel.svg?style=flat-square&maxAge=180
[badge_commits_since_release]:https://img.shields.io/github/commits-since/avtocod/b2b-api-php-laravel/latest.svg?style=flat-square&maxAge=180
[badge_issues]:https://img.shields.io/github/issues/avtocod/b2b-api-php-laravel.svg?style=flat-square&maxAge=180
[badge_pulls]:https://img.shields.io/github/issues-pr/avtocod/b2b-api-php-laravel.svg?style=flat-square&maxAge=180
[link_releases]:https://github.com/avtocod/b2b-api-php-laravel/releases
[link_packagist]:https://packagist.org/packages/avtocod/b2b-api-php-laravel
[link_build_status]:https://github.com/avtocod/b2b-api-php-laravel/actions
[link_coverage]:https://codecov.io/gh/avtocod/b2b-api-php-laravel/
[link_changes_log]:https://github.com/avtocod/b2b-api-php-laravel/blob/master/CHANGELOG.md
[link_issues]:https://github.com/avtocod/b2b-api-php-laravel/issues
[link_create_issue]:https://github.com/avtocod/b2b-api-php-laravel/issues/new/choose
[link_commits]:https://github.com/avtocod/b2b-api-php-laravel/commits
[link_pulls]:https://github.com/avtocod/b2b-api-php-laravel/pulls
[link_license]:https://github.com/avtocod/b2b-api-php-laravel/blob/master/LICENSE
[b2b_api_client_laravel]:https://github.com/avtocod/b2b-api-php
[getcomposer]:https://getcomposer.org/download/
[link_laravel_events]:https://laravel.com/docs/5.8/events
