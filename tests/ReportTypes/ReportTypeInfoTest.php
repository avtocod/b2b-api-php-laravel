<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Laravel\Tests\ReportTypes;

use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\CoversClass;
use Avtocod\B2BApi\Laravel\Tests\AbstractTestCase;
use Avtocod\B2BApi\Laravel\ReportTypes\ReportTypeInfo;
use Avtocod\B2BApi\Laravel\ReportTypes\ReportTypeInfoInterface;

#[CoversClass(ReportTypeInfo::class)]
class ReportTypeInfoTest extends AbstractTestCase
{
    /**
     * @var ReportTypeInfo
     */
    protected $instance;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->instance = new ReportTypeInfo($uid = Str::random());
    }

    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $this->assertInstanceOf(ReportTypeInfoInterface::class, $this->instance);
    }

    /**
     * @return void
     */
    public function testGetters(): void
    {
        $instance = new ReportTypeInfo($uid = Str::random());

        $this->assertSame($uid, $instance->getUid());
        $this->assertSame($uid, (string) $instance);
    }
}
