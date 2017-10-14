
<p align="center">
  <img alt="laravel" src="https://habrastorage.org/webt/59/e1/c4/59e1c40b83e9d293787547.png" width="70" height="70" /> <img alt="logo" src="https://habrastorage.org/webt/59/df/45/59df45aa6c9cb971309988.png" width="70" height="70" />
</p>

# Сервис для работы с B2B API ресурса "avtocod" для Laravel 5

![Packagist](https://img.shields.io/packagist/v/avtocod/b2b-api-php-laravel.svg?style=flat&maxAge=30)
[![Build Status](https://scrutinizer-ci.com/g/avtocod/b2b-api-php-laravel/badges/build.png?b=master)](https://scrutinizer-ci.com/g/avtocod/b2b-api-php-laravel/build-status/master)
![StyleCI](https://styleci.io/repos/106925654/shield?style=flat&maxAge=30)
[![Code Coverage](https://scrutinizer-ci.com/g/avtocod/b2b-api-php-laravel/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/avtocod/b2b-api-php-laravel/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/avtocod/b2b-api-php-laravel/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/avtocod/b2b-api-php-laravel/?branch=master)
![GitHub issues](https://img.shields.io/github/issues/avtocod/b2b-api-php-laravel.svg?style=flat&maxAge=30)

При помощи данного пакета вы сможете интегрировать сервис по работе с B2B API ресурса "avtocod" в ваше **Laravel 5.x** приложение с помощью нескольких простых шагов.

## Установка

Для установки данного пакета выполните в терминале следующую команду:

```shell
$ composer require avtocod/b2b-api-php-laravel "2.*"
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

## Лицензирование

Код данного пакета распространяется под лицензией **MIT**.

[getcomposer]:https://getcomposer.org/download/
[b2b_api_client_laravel]:https://github.com/avto-dev/b2b-api-php-laravel
