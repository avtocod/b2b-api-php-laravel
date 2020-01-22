<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Laravel\ReportTypes;

use Countable;
use RuntimeException;

class Repository implements RepositoryInterface, Countable
{
    /**
     * @var ReportTypeInfo[]|array
     */
    protected $report_types;

    /**
     * @var string|null
     */
    protected $default_name;

    /**
     * Create a new Repository instance.
     *
     * @param mixed[]     $settings     An array with report types settings (like `['name' => ['uid' => '...'], ...]`)
     * @param string|null $default_name Default report type name
     */
    public function __construct(array $settings, ?string $default_name = null)
    {
        foreach ($settings as $name => $options) {
            $this->report_types[$name] = new ReportTypeInfo($options['uid']);
        }

        $this->default_name = $default_name;
    }

    /**
     * {@inheritdoc}
     *
     * @throws RuntimeException
     */
    public function get(string $name): ReportTypeInfo
    {
        if (! $this->has($name)) {
            throw new RuntimeException("Report type named [$name] does not exists");
        }

        return $this->report_types[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $name): bool
    {
        return isset($this->report_types[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function names(): array
    {
        return \array_keys($this->report_types);
    }

    /**
     * {@inheritdoc}
     *
     * @throws RuntimeException
     */
    public function default(): ReportTypeInfo
    {
        if ($this->default_name === null) {
            throw new RuntimeException('Default report type name does not set');
        }

        return $this->get($this->default_name);
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return \count($this->report_types);
    }
}
