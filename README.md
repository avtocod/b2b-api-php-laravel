<p align="center">
  <img src="https://laravel.com/assets/img/components/logo-laravel.svg" alt="Laravel" width="240" />
</p>

# Расширенный клиент для работы с B2B API ресурса "avtocod"

[![Version][badge_packagist_version]][link_packagist]
[![Version][badge_php_version]][link_packagist]
[![Build Status][badge_build_status]][link_build_status]
[![Coverage][badge_coverage]][link_coverage]
[![Code quality][badge_code_quality]][link_code_quality]
[![Downloads count][badge_downloads_count]][link_packagist]
[![License][badge_license]][link_license]

При помощи данного пакета вы сможете интегрировать сервис по работе с B2B API ресурса "avtocod" в ваше **Laravel &gt;=5.4** приложение с помощью нескольких простых шагов.

## Установка

Для установки данного пакета выполните в терминале следующую команду:

```shell
$ composer require avtocod/b2b-api-php-laravel "^2.2"
```

> Для этого необходим установленный `composer`. Для его установки перейдите по [данной ссылке][getcomposer].

> Обратите внимание на то, что необходимо фиксировать мажорную версию устанавливаемого пакета.

Если вы используете Laravel версии 5.5 и выше, то сервис-провайдер данного пакета будет зарегистрирован автоматически. В противном случае вам необходимо самостоятельно зарегистрировать сервис-провайдер в секции `providers` файла `./config/app.php`:

```php
'providers' => [
    // ...
    Avtocod\B2BApiLaravel\B2BApiServiceProvider::class,
]
```

После чего "опубликуйте" необходимые для пакета ресурсы с помощью команды:

```shell
$ ./artisan vendor:publish --provider="Avtocod\B2BApiLaravel\B2BApiServiceProvider"
```

> Данная команда создаст файл `./config/b2b-api-client.php` с настройками "по умолчанию", которые вам следует переопределить на свои.

После чего откройте файл `./config/b2b-api-client.php` и укажите в нем ваши реквизиты для подключения к сервису B2B API.

> С новыми версиями пакета могут добавляться новые опции в конфигурационном файле. Пожалуйста, не забывайте время от времени проверять этот момент.

## Использование

Данный пакет является пред-настроенной реализацией универсального пакета, который реализует весь функционал сервиса.

Для получения подробной информации о работе с сервисом и его документацией, пожалуйста, перейдите по следующей ссылке: **[avto-dev/b2b-api-php-laravel][b2b_api_client_laravel]**.

### Testing

For package testing we use `phpunit` framework. Just write into your terminal:

```shell
$ git clone git@github.com:avtocod/b2b-api-php-laravel.git ./b2b-api-php-laravel && cd $_
$ composer install
$ composer test
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
[badge_build_status]:https://travis-ci.org/avtocod/b2b-api-php-laravel.svg?branch=master
[badge_code_quality]:https://img.shields.io/scrutinizer/g/avtocod/b2b-api-php-laravel.svg?maxAge=180
[badge_coverage]:https://img.shields.io/codecov/c/github/avtocod/b2b-api-php-laravel/master.svg?maxAge=60
[badge_downloads_count]:https://img.shields.io/packagist/dt/avtocod/b2b-api-php-laravel.svg?maxAge=180
[badge_license]:https://img.shields.io/packagist/l/avtocod/b2b-api-php-laravel.svg?longCache=true
[badge_release_date]:https://img.shields.io/github/release-date/avtocod/b2b-api-php-laravel.svg?style=flat-square&maxAge=180
[badge_commits_since_release]:https://img.shields.io/github/commits-since/avtocod/b2b-api-php-laravel/latest.svg?style=flat-square&maxAge=180
[badge_issues]:https://img.shields.io/github/issues/avtocod/b2b-api-php-laravel.svg?style=flat-square&maxAge=180
[badge_pulls]:https://img.shields.io/github/issues-pr/avtocod/b2b-api-php-laravel.svg?style=flat-square&maxAge=180
[link_releases]:https://github.com/avtocod/b2b-api-php-laravel/releases
[link_packagist]:https://packagist.org/packages/avtocod/b2b-api-php-laravel
[link_build_status]:https://travis-ci.org/avtocod/b2b-api-php-laravel
[link_coverage]:https://codecov.io/gh/avtocod/b2b-api-php-laravel/
[link_changes_log]:https://github.com/avtocod/b2b-api-php-laravel/blob/master/CHANGELOG.md
[link_code_quality]:https://scrutinizer-ci.com/g/avtocod/b2b-api-php-laravel/
[link_issues]:https://github.com/avtocod/b2b-api-php-laravel/issues
[link_create_issue]:https://github.com/avtocod/b2b-api-php-laravel/issues/new/choose
[link_commits]:https://github.com/avtocod/b2b-api-php-laravel/commits
[link_pulls]:https://github.com/avtocod/b2b-api-php-laravel/pulls
[link_license]:https://github.com/avtocod/b2b-api-php-laravel/blob/master/LICENSE
[b2b_api_client_laravel]:https://github.com/avto-dev/b2b-api-php-laravel
