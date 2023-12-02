<?php

declare(strict_types=1);

namespace Platine\Test\Fixture\UserAgent;

use Platine\UserAgent\Detector\AbstractDetector;
use Platine\UserAgent\Entity\Browser;

class CustomDetector extends AbstractDetector
{
    public function __construct()
    {
        parent::__construct();
        $this->entity = new Browser();
    }

    public function maps(): array
    {
        return [];
    }

    public function regex(): array
    {
        return [
            [
                '/(foo)/i'
            ], [self::MODEL, self::VENDOR, [self::TYPE, '/foo/', self::MODEL, '__lowerize']]
        ];
    }
}
