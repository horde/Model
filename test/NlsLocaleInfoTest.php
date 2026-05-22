<?php

declare(strict_types=1);

namespace Horde\Model\Test;

use Horde_Nls;
use Horde\Nls\Nls;
use PHPUnit\Framework\TestCase;

/**
 * Tests that PSR-4 Nls::getLocaleInfo() returns the same structure as
 * the legacy Horde_Nls::getLocaleInfo() that Model's Number type uses.
 *
 * The Number type depends on: mon_decimal_point, mon_thousands_sep
 * @coversNothing
 */
class NlsLocaleInfoTest extends TestCase
{
    public function testLegacyGetLocaleInfoReturnsExpectedKeys(): void
    {
        $info = Horde_Nls::getLocaleInfo();

        $this->assertIsArray($info);
        $this->assertArrayHasKey('decimal_point', $info);
        $this->assertArrayHasKey('thousands_sep', $info);
        $this->assertArrayHasKey('mon_decimal_point', $info);
        $this->assertArrayHasKey('mon_thousands_sep', $info);
    }

    public function testPsr4GetLocaleInfoReturnsExpectedKeys(): void
    {
        $nls = new Nls();
        $info = $nls->getLocaleInfo();

        $this->assertIsArray($info);
        $this->assertArrayHasKey('decimal_point', $info);
        $this->assertArrayHasKey('thousands_sep', $info);
        $this->assertArrayHasKey('mon_decimal_point', $info);
        $this->assertArrayHasKey('mon_thousands_sep', $info);
    }

    public function testBothReturnSameValues(): void
    {
        $legacy = Horde_Nls::getLocaleInfo();
        $psr4 = (new Nls())->getLocaleInfo();

        $this->assertEquals($legacy['decimal_point'], $psr4['decimal_point']);
        $this->assertEquals($legacy['thousands_sep'], $psr4['thousands_sep']);
        $this->assertEquals($legacy['mon_decimal_point'], $psr4['mon_decimal_point']);
        $this->assertEquals($legacy['mon_thousands_sep'], $psr4['mon_thousands_sep']);
    }
}
