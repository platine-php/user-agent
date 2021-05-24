<?php

declare(strict_types=1);

namespace Platine\Test\Fixture\UserAgent;

use Platine\UserAgent\Detector\AbstractDetector;
use Platine\UserAgent\Entity\AbstractEntity;
use Platine\UserAgent\Entity\Browser;

class CustomDetector extends AbstractDetector
{

    public function entity(): AbstractEntity
    {
        return new Browser();
    }

    public function maps(): array
    {
        return [];
    }

    public function regex(): array
    {
        return [
            [
                '/(opios)[\/\s]+([\w\.]+)/i'
            ], [self::MODEL, self::VENDOR, [self::TYPE, '/foo/', self::MODEL, '__lowerize']]
        ];
    }
}
