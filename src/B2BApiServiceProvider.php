<?php

namespace Avtocod\B2BApiLaravel;

use AvtoDev\B2BApiLaravel\B2BApiServiceProvider as VendorB2BApiServiceProvider;

/**
 * Class B2BApiServiceProvider.
 *
 * Сервис-провайдер пакета, реализующего работу с сервисом B2B API.
 */
class B2BApiServiceProvider extends VendorB2BApiServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public static function getConfigFilePath()
    {
        return __DIR__ . '/../config/b2b-api-client.php';
    }
}
