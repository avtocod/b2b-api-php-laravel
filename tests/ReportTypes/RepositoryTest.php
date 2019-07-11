<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Laravel\Tests\ReportTypes;

use Avtocod\B2BApi\Laravel\ReportTypes\Repository;
use Avtocod\B2BApi\Laravel\Tests\AbstractTestCase;
use Avtocod\B2BApi\Laravel\ReportTypes\RepositoryInterface;
use Illuminate\Support\Str;
use RuntimeException;

/**
 * @covers \Avtocod\B2BApi\Laravel\ReportTypes\Repository
 */
class RepositoryTest extends AbstractTestCase
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @var array[]
     */
    protected $settings = [
        'report-type-1' => [
            'uid' => 'foo@bar',
        ],
        'report-type-2' => [
            'uid' => 'baz@blah',
        ],
    ];

    /**
     * @var string
     */
    protected $default = 'report-type-1';

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new Repository($this->settings, $this->default);
    }

    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(RepositoryInterface::class, $this->repository);
    }

    /**
     * @return void
     */
    public function testNamesGetter(): void
    {
        $this->assertSame(\array_keys($this->settings), $this->repository->names());
    }

    /**
     * @small
     *
     * @return void
     */
    public function testInstanceGetting(): void
    {
        $this->assertSame($this->repository->default(), $this->repository->default());
        $this->assertSame($this->repository->get('report-type-2'), $this->repository->get('report-type-2'));
    }

    /**
     * @small
     *
     * @return void
     */
    public function testHas(): void
    {
        $this->assertTrue($this->repository->has('report-type-1'));
        $this->assertTrue($this->repository->has('report-type-2'));
        $this->assertFalse($this->repository->has(Str::random()));
    }

    /**
     * @small
     *
     * @return void
     */
    public function testDefault(): void
    {
        $this->assertSame($this->settings[$this->default]['uid'], $this->repository->default()->getUid());
    }

    /**
     * @small
     *
     * @return void
     */
    public function testDefaultThrownAnException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageRegExp('~Default.*not set~i');

        $this->repository = new Repository($this->settings);

        $this->repository->default();
    }

    /**
     * @small
     *
     * @return void
     */
    public function testGetThrownAnException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageRegExp('~named.*not exist~i');

        $this->repository->get(Str::random());
    }

    /**
     * @small
     *
     * @return void
     */
    public function testCount(): void
    {
        $this->assertSameSize($this->settings, $this->repository);
    }
}
