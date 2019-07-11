<?php

declare(strict_types = 1);

namespace Avtocod\B2BApi\Laravel\Tests\ReportTypes;

use Illuminate\Support\Str;
use Avtocod\B2BApi\Laravel\Tests\AbstractTestCase;
use Avtocod\B2BApi\Laravel\ReportTypes\ReportTypeInfo;

/**
 * @covers \Avtocod\B2BApi\Laravel\ReportTypes\ReportTypeInfo
 */
class ReportTypeInfoTest extends AbstractTestCase
{
    /**
     * @small
     *
     * @return void
     */
    public function testGetters(): void
    {
        $instance = new ReportTypeInfo($uid = Str::random());

        $this->assertSame($uid, $instance->getUid());
        $this->assertSame($uid, (string) $instance);
    }
}
