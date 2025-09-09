<?php

declare(strict_types=1);

namespace Platine\Test\UserAgent;

use Platine\Dev\PlatineTestCase;
use Platine\UserAgent\UserAgent;

/**
 * UserAgent class tests
 *
 * @group core
 * @group user-agent
 */
class UserAgentTest extends PlatineTestCase
{
    /**
     * test Validate method
     *
     * @dataProvider allTestsDataProvider
     *
     */
    public function testAll(
        string $ua,
        int $bm,
        string $bn,
        string $bv,
        string $ca,
        string $dm,
        string $dt,
        string $dv,
        string $en,
        int $em,
        string $ev,
        int $om,
        string $on,
        string $ov
    ): void {
        $s = new UserAgent($ua);

        $this->assertEquals($bm, $s->browser()->getMajor());
        $this->assertEquals($bn, $s->browser()->getName());
        $this->assertEquals($bv, $s->browser()->getVersion());
        $this->assertEquals($ca, $s->cpu()->getArchitecture());
        $this->assertEquals($dm, $s->device()->getModel());
        $this->assertEquals($dt, $s->device()->getType());
        $this->assertEquals($dv, $s->device()->getVendor());
        $this->assertEquals($em, $s->engine()->getMajor());
        $this->assertEquals($en, $s->engine()->getName());
        $this->assertEquals($ev, $s->engine()->getVersion());
        $this->assertEquals($om, $s->os()->getMajor());
        $this->assertEquals($on, $s->os()->getName());
        $this->assertEquals($ov, $s->os()->getVersion());
    }


    /**
     * Data provider for "testAll"
     * @return array
     */
    public function allTestsDataProvider(): array
    {
        return [
            [
                'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0; Xbox; Xbox One)',
                10,
                'IE',
                '10.0',
                '',
                'Xbox',
                'console',
                'Microsoft',
                'Trident',
                6,
                '6.0',
                0,
                'Windows',
                '',
            ],
            [
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; Xbox)',
                9,
                'IE',
                '9.0',
                '',
                'Xbox',
                'console',
                'Microsoft',
                'Trident',
                5,
                '5.0',
                0,
                'Windows',
                '',
            ],
            [
                'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534+ (KHTML, like Gecko) BingPreview/1.0b',
                534,
                'WebKit',
                '534',
                'amd64',
                '',
                '',
                '',
                'WebKit',
                534,
                '534',
                0,
                'Windows',
                '',
            ],
            [
                'mwb-db-client Opera/9.80 (Linux armv7l ; U; HbbTV/1.1.1 (; TOSHIBA; 32SL863; 19.2.39.208; 3; ) ; ToshibaTP/1.1.1 () ; en) Presto/2.6.33 Version/10.60',
                10,
                'Opera',
                '10.60',
                'arm',
                '32SL863',
                'smart-tv',
                'TOSHIBA',
                'Presto',
                2,
                '2.6.33',
                7,
                'Linux',
                'armv7l',
            ],
            [
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36',
                90,
                'Chrome',
                '90.0.4430.212',
                'amd64',
                '',
                '',
                '',
                'Blink',
                0,
                '',
                10,
                'Windows',
                '10',
            ],
            [
                'Mozilla/5.0 (Linux; Android 8.0.0; SM-G960F Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.84 Mobile Safari/537.36',
                62,
                'Chrome',
                '62.0.3202.84',
                '',
                'SM-G960F',
                'mobile',
                'Samsung',
                'Blink',
                0,
                '',
                8,
                'Android',
                '8.0.0',
            ],
            [
                'Mozilla/5.0 (iPhone9,3; U; CPU iPhone OS 10_0_1 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/14A403 Safari/602.1',
                10,
                'Mobile Safari',
                '10.0',
                '',
                'Mobile',
                'mobile',
                'Mobile',
                'WebKit',
                602,
                '602.1.50',
                10,
                'iOS',
                '10.0.1',
            ],
            [
                'Mozilla/5.0 (Linux; Android 7.0; Pixel C Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/52.0.2743.98 Safari/537.36',
                52,
                'Chrome WebView',
                '52.0.2743.98',
                '',
                'Pixel C',
                'tablet',
                'Google',
                'Blink',
                0,
                '',
                7,
                'Android',
                '7.0',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.2; en-us; Sprint APA9292KT Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                4,
                'Android Browser',
                '4.0',
                '',
                '',
                'mobile',
                '',
                'WebKit',
                533,
                '533.1',
                2,
                'Android',
                '2.2',
            ],
            [
                'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420+ (KHTML, like Gecko) Version/3.0 Mobile/1A543a Safari/419.3',
                3,
                'Mobile Safari',
                '3.0',
                '',
                'iPhone',
                'mobile',
                'Apple',
                'WebKit',
                420,
                '420',
                0,
                'Mac OS',
                '',
            ]
        ];
    }
}
