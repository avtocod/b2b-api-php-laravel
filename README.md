<p align="center">
  <img src="https://laravel.com/assets/img/components/logo-laravel.svg" alt="Laravel" width="240" />
</p>

# Расширенный клиент для работы с B2B API ресурса "avtocod"

[![Version][badge_version]][link_packagist]
[![Build Status][badge_build_status]][link_build_status]
[![StyleCI][badge_styleci]][link_styleci]
[![Coverage][badge_coverage]][link_coverage]
[![Code Quality][badge_quality]][link_coverage]
[![Issues][badge_issues]][link_issues]
[![License][badge_license]][link_license]
[![Downloads count][badge_downloads_count]][link_packagist]

При помощи данного пакета вы сможете интегрировать сервис по работе с B2B API ресурса "avtocod" в ваше **Laravel &gt;=5.4** приложение с помощью нескольких простых шагов.

## Установка

Для установки данного пакета выполните в терминале следующую команду:

```shell
$ composer require avtocod/b2b-api-php-laravel "^2.3"
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

## Поддержка и развитие

Если у вас возникли какие-либо проблемы по работе с данным пакетом, пожалуйста, создайте соответствующий `issue` в репозитории [по этой ссылке][b2b_api_client_laravel].

Если вы способны самостоятельно реализовать тот функционал, что вам необходим - создайте PR с соответствующими изменениями. Крайне желательно сопровождать PR соответствующими тестами, фиксирующими работу ваших изменений. После проверки и принятия изменений будет опубликована новая минорная версия.

## Лицензирование

Код данного пакета распространяется под лицензией [MIT][link_license].

[badge_version]:https://img.shields.io/packagist/v/avtocod/b2b-api-php-laravel.svg?style=flat&maxAge=30
[badge_downloads_count]:https://img.shields.io/packagist/dt/avtocod/b2b-api-php-laravel.svg?style=flat&maxAge=30
[badge_license]:https://img.shields.io/packagist/l/avtocod/b2b-api-php-laravel.svg?style=flat&maxAge=30
[badge_build_status]:https://scrutinizer-ci.com/g/avtocod/b2b-api-php-laravel/badges/build.png?b=master
[badge_styleci]:https://styleci.io/repos/106925654/shield
[badge_coverage]:https://scrutinizer-ci.com/g/avtocod/b2b-api-php-laravel/badges/coverage.png?b=master
[badge_quality]:https://scrutinizer-ci.com/g/avtocod/b2b-api-php-laravel/badges/quality-score.png?b=master
[badge_issues]:https://img.shields.io/github/issues/avtocod/b2b-api-php-laravel.svg?style=flat&maxAge=30
[link_packagist]:https://packagist.org/packages/avtocod/b2b-api-php-laravel
[link_styleci]:https://styleci.io/repos/106925654/
[link_license]:https://github.com/avtocod/b2b-api-php-laravel/blob/master/LICENSE
[link_build_status]:https://scrutinizer-ci.com/g/avtocod/b2b-api-php-laravel/build-status/master
[link_coverage]:https://scrutinizer-ci.com/g/avtocod/b2b-api-php-laravel/?branch=master
[link_issues]:https://github.com/avtocod/b2b-api-php-laravel/issues
[getcomposer]:https://getcomposer.org/download/
[b2b_api_client_laravel]:https://github.com/avto-dev/b2b-api-php-laravel
