<?php

namespace Avtocod\B2BApi\Laravel\ReportTypes;

interface ReportTypeInfoInterface
{
    /**
     * Get report type UID.
     *
     * @return string
     */
    public function getUid(): string;
}
