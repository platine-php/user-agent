<?php

declare(strict_types=1);

namespace Platine\Test\UserAgent\Detector;

use Platine\Dev\PlatineTestCase;
use Platine\UserAgent\Entity\Device;

/**
 * Device class tests
 *
 * @group core
 * @group user-agent
 */
class DeviceTest extends PlatineTestCase
{
    public function testToString(): void
    {
        $s = new Device();

        $s->setModel('iPhone');
        $s->setVendor('Apple');
        $s->setType('Mobile');

        $this->assertEquals('iPhone, Apple Mobile', $s->__toString());
    }
}
