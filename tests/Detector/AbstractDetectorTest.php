<?php

declare(strict_types=1);

namespace Platine\Test\UserAgent\Detector;

use Platine\Dev\PlatineTestCase;
use Platine\Test\Fixture\UserAgent\CustomDetector;

/**
 * AbstractDetector class tests
 *
 * @group core
 * @group user-agent
 */
class AbstractDetectorTest extends PlatineTestCase
{
    public function testCustomDetector(): void
    {
        $s = new CustomDetector();

        $s->detect('my fooo');
        $en = $s->entity();

        $this->assertEquals('', $en->getName());
        $this->assertEquals('', $en->getVersion());
        $this->assertEquals(0, $en->getMajor());
    }

    public function testStrMethod(): void
    {
        $s = new CustomDetector();

        $en = $this->runPrivateProtectedMethod($s, 'str', ['key', ['key' => 'ekeye']]);
        $this->assertEquals('key', $en);
    }

    public function testTrimMethod(): void
    {
        $s = new CustomDetector();

        $en = $this->runPrivateProtectedMethod($s, 'trim', ['key.value']);
        $this->assertEquals('key.value', $en);
    }

    public function testLowerizeMethodUsingStrtolower(): void
    {
        global $mock_function_exists_to_false;
        $mock_function_exists_to_false = true;

        $s = new CustomDetector();

        $en = $this->runPrivateProtectedMethod($s, 'lowerize', ['TNh']);
        $this->assertEquals('tnh', $en);
    }
}
