<?php

declare(strict_types=1);

namespace Platine\Test\UserAgent\Detector;

use Platine\PlatineTestCase;
use Platine\UserAgent\Entity\Browser;

/**
 * Browser class tests
 *
 * @group core
 * @group user-agent
 */
class BrowserTest extends PlatineTestCase
{

    public function testToString(): void
    {
        $s = new Browser();

        $s->setName('Chrome');
        $s->setVersion('10.8.2');
        
        $this->assertEquals('Chrome 10.8.2', $s->__toString());
    }    
}
