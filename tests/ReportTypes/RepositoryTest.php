<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Laravel\Tests\ReportTypes;

use RuntimeException;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\CoversClass;
use Avtocod\B2BApi\Laravel\ReportTypes\Repository;
use Avtocod\B2BApi\Laravel\Tests\AbstractTestCase;
use Avtocod\B2BApi\Laravel\ReportTypes\RepositoryInterface;

#[
    CoversClass(Repository::class),
    Small,
]
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

    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(RepositoryInterface::class, $this->repository);
    }

    public function testNamesGetter(): void
    {
        $this->assertSame(\array_keys($this->settings), $this->repository->names());
    }

    public function testInstanceGetting(): void
    {
        $this->assertSame($this->repository->default(), $this->repository->default());
        $this->assertSame($this->repository->get('report-type-2'), $this->repository->get('report-type-2'));
    }

    public function testHas(): void
    {
        $this->assertTrue($this->repository->has('report-type-1'));
        $this->assertTrue($this->repository->has('report-type-2'));
        $this->assertFalse($this->repository->has(Str::random()));
    }

    public function testDefault(): void
    {
        $this->assertSame($this->settings[$this->default]['uid'], $this->repository->default()->getUid());
    }

    public function testDefaultThrownAnException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageMatches('~Default.*not set~i');

        $this->repository = new Repository($this->settings);

        $this->repository->default();
    }

    public function testGetThrownAnException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageMatches('~named.*not exist~i');

        $this->repository->get(Str::random());
    }

    public function testCount(): void
    {
        $this->assertSameSize($this->settings, $this->repository);
    }
}
