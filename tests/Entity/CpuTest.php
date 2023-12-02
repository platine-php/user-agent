<?php

declare(strict_types=1);

namespace Platine\Test\UserAgent\Detector;

use Platine\Dev\PlatineTestCase;
use Platine\UserAgent\Entity\Cpu;

/**
 * Cpu class tests
 *
 * @group core
 * @group user-agent
 */
class CpuTest extends PlatineTestCase
{
    public function testToString(): void
    {
        $s = new Cpu();

        $s->setArchitecture('amd64');

        $this->assertEquals('amd64', $s->__toString());
        $this->assertEquals('amd64', $s->getArchitecture());
    }
}
