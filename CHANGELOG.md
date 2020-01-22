# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog][keepachangelog] and this project adheres to [Semantic Versioning][semver].

## v3.1.0

### Added

- Laravel v6.x support
- Tests running using GitHub Actions
- PHP 7.4 tests running

### Changed

- StyleCI rules. Enabled: `length_ordered_imports`, disabled: `alpha_ordered_imports`
- Updated dev-dependency versions

## v3.0.0

### Added

- Docker-based environment for development
- Project `Makefile`
- Environment variables `B2B_API_REPORT_TYPE_UID`, `B2B_API_AUTH_TOKEN`, `B2B_API_AUTH_USERNAME`, `B2B_API_AUTH_PASSWORD`, `B2B_API_AUTH_DOMAIN`, `B2B_API_TOKEN_LIFETIME` support
- Classes:
  - `\Avtocod\B2BApi\Laravel\Connections\ConnectionsFactory`
  - `\Avtocod\B2BApi\Laravel\ReportTypes\ReportTypeInfo`
  - `\Avtocod\B2BApi\Laravel\ReportTypes\Repository`
- Interfaces:
  - `\Avtocod\B2BApi\Laravel\Connections\ConnectionsFactoryInterface`
  - `\Avtocod\B2BApi\Laravel\ReportTypes\RepositoryInterface`

### Changed

- Minimal `PHP` version now is `^7.1.3`
- Maximal `Laravel` version now is `5.8.x`
- Dependency `avto-dev/b2b-api-php` changed to `avtocod/b2b-api-php`
- Dependency `laravel/framework` changed to `illuminate/*`
- Root package namespace changed from `\Avtocod\B2BApiLaravel` to `\Avtocod\B2BApi\Laravel`
- Composer scripts
- `\Avtocod\B2BApiLaravel\B2BApiServiceProvider` &rarr; `Avtocod\B2BApi\Laravel\ServiceProvider`
- Configuration file structure (root keys `api_base_uri`, `domain`, `username`, `password`, `webhooks`, `is_test` removed; `default_report_type`, `connections`, `default_connection` added; `report_types` changes own structure)
- DI bindings

### Removed

- Dependency `avto-dev/b2b-api-php-laravel`
- Environment variables `B2B_API_CLIENT_DOMAIN`, `B2B_API_CLIENT_USERNAME`, `B2B_API_CLIENT_PASSWORD`, `B2B_API_DEFAULT_REPORT_TYPE`, `B2B_API_WEBHOOK_ON_COMPLETE`, `B2B_API_WEBHOOK_ON_UPDATE`, `B2B_API_IS_TEST` support

## v2.2.0

### Changed

- Maximal PHP version now is undefined
- Maximal Laravel version now is `5.7.*`
- CI changed to [Travis CI][travis]
- [CodeCov][codecov] integrated
- Issue templates updated

[travis]:https://travis-ci.org/
[codecov]:https://codecov.io/

## v2.1.0

## v2.0.4

## v2.0.3

## v2.0.2

## v2.0.1

## v2.0.0

### Changed

- First release

[keepachangelog]:https://keepachangelog.com/en/1.0.0/
[semver]:https://semver.org/spec/v2.0.0.html
