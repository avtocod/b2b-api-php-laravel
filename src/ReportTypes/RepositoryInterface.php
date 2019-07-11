<?php

namespace Avtocod\B2BApi\Laravel\ReportTypes;

/**
 * @see \Avtocod\B2BApi\Laravel\ReportTypes\Repository
 */
interface RepositoryInterface
{
    /**
     * Get report type info by report type name.
     *
     * @param string $name
     *
     * @return ReportTypeInfo
     */
    public function get(string $name): ReportTypeInfo;

    /**
     * Determine if report type is exists or not.
     *
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name): bool;

    /**
     * Get all report type names.
     *
     * @return string[]
     */
    public function names(): array;

    /**
     * Get default report type.
     *
     * @return ReportTypeInfo
     */
    public function default(): ReportTypeInfo;
}
