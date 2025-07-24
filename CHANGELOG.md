# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog][keepachangelog] and this project adheres to [Semantic Versioning][semver].

## Unreleased

### Added

- Laravel `12.x` support

### Changed

- Version of `composer` in `Dockerfile` updated up to `2.8.10`
- Update dev dependencies

## v4.5.0

### Added

- Support for Laravel 11

### Changed

- Composer updated from v2.6.6 to v2.8.3

### Removed

- Obsolete attribute `version` from docker-compose.yml

## v4.4.0

### Added

- Support Laravel 10

### Changed

- Up minimal `PHP` version to `8.1`
- Up minimal `phpstan` version to `1.10`
- Up minimal `phpunit` version to `10.5`
- Composer updated to v2 on CI

### Fixed

- Inconsistency with real method signatures in `README.md` [#18]

[#18]:https://github.com/avtocod/b2b-api-php-laravel/issues/18

## v4.3.0

### Added

- Support PHP `8.x` [#16]
- Laravel `9.x` is supported now

### Changed

- Composer `2.x` is supported now
- Minimal PHP version now is `7.3`

[#16]:https://github.com/avtocod/b2b-api-php-laravel/issues/16

## v4.2.0

### Changed

- Package `tarampampam/guzzle-url-mock` replaced with `avto-dev/guzzle-url-mock` version `^1.5`

## v4.1.0

### Changed

- Minimal required `avtocod/b2b-api-php` package version now is `^4.1`
- Using method `expectExceptionMessageMatches` instead of `expectExceptionMessageRegExp` in tests

## v4.0.0

### Changed

- Minimal required `avtocod/b2b-api-php` package version now is `^4.0` (instead of `^3.3`)
- PhpDoc annotations updated

## v3.4.0

### Changed

- Laravel `8.x` is supported now
- Minimal Laravel version now is `6.0` (Laravel `5.5` LTS got last security update August 30th, 2020)
- Minimal required `avtocod/b2b-api-php` version now is `^3.3`
- CI completely moved from "Travis CI" to "Github Actions" _(travis builds disabled)_
- Minimal required PHP version now is `7.2`

## v3.3.0

### Changed

- Maximal `illuminate/*` packages version now is `7.*`

## v3.2.0

### Added

- Interface `ReportTypeInfoInterface`

### Changed

- Report type repository method `get` now will return `ReportTypeInfoInterface`
- Report type repository method `default` now will return `ReportTypeInfoInterface`

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
