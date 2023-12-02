<?php

declare(strict_types=1);

namespace Platine\Test\UserAgent\Detector;

use Platine\Dev\PlatineTestCase;
use Platine\UserAgent\Util\Helper;

/**
 * Helper class tests
 *
 * @group core
 * @group user-agent
 */
class HelperTest extends PlatineTestCase
{
    public function testGetMajorVersion(): void
    {
        $res = Helper::getMajorVersion('78.88');
        $this->assertEquals(78, $res);
    }

    public function testGetMajorVersionPregReplaceReturnNull(): void
    {
        global $mock_preg_replace_to_null;
        $mock_preg_replace_to_null = true;
        $res = Helper::getMajorVersion('78.88');
        $this->assertEquals(0, $res);
    }

    public function testReplaceFirst(): void
    {
        $res = Helper::replaceFirst('i', 'j', 'mytiti');
        $this->assertEquals('mytjti', $res);
    }

    public function testReplaceFirstPregReplaceReturnNull(): void
    {
        global $mock_preg_replace_to_null;
        $mock_preg_replace_to_null = true;
        $res = Helper::replaceFirst('i', 'j', 'mytiti');
        $this->assertEmpty($res);
    }
}
