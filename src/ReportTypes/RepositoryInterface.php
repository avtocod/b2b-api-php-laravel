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
     * @return ReportTypeInfoInterface
     */
    public function get(string $name): ReportTypeInfoInterface;

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
     * @return ReportTypeInfoInterface
     */
    public function default(): ReportTypeInfoInterface;
}
