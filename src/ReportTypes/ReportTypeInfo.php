<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Laravel\ReportTypes;

class ReportTypeInfo
{
    /**
     * @var string
     */
    protected $uid;

    /**
     * Create a new ReportTypeInfo instance.
     *
     * @param string $uid
     */
    public function __construct(string $uid)
    {
        $this->uid = $uid;
    }

    /**
     * Get report type UID.
     *
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }
}
