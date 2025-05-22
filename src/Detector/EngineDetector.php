<?php

/**
 * Platine User Agent
 *
 * Platine User Agent is a lightweight library for detecting
 * user browser, device, OS, CPU
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2020 Platine User Agent
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

/**
 *  @file EngineDetector.php
 *
 *  The engine detector class
 *
 *  @package    Platine\UserAgent\Detector
 *  @author Platine Developers Team
 *  @copyright  Copyright (c) 2020
 *  @license    http://opensource.org/licenses/MIT  MIT License
 *  @link   https://www.platine-php.com
 *  @version 1.0.0
 *  @filesource
 */

declare(strict_types=1);

namespace Platine\UserAgent\Detector;

use Platine\UserAgent\Entity\Engine;

/**
 * @class EngineDetector
 * @package Platine\UserAgent\Detector
 */
class EngineDetector extends AbstractDetector
{
    /**
    * {@inheritdoc}
    */
    public function __construct()
    {
        parent::__construct();

        $this->entity = new Engine();
    }

    /**
     * {@inheritdoc}
     */
    public function maps(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function regex(): array
    {
        return [
            [
                '/windows.+\sedge\/([\w\.]+)/i '                                      // EdgeHTML
            ], [self::VERSION, [self::NAME, 'EdgeHTML']], [

                '/webkit\/537\.36.+chrome\/(?!27)/i'                                  // Blink
            ], [[self::NAME, 'Blink']], [

                '/(presto)\/([\w\.]+)/i',                                             // Presto
                '/(webkit|trident|netfront|netsurf|amaya|lynx|w3m|goanna)\/([\w\.]+)/i',
                // WebKit/Trident/NetFront/NetSurf/Amaya/Lynx/w3m/Goanna
                '/(khtml|tasman|links)[\/\s]\(?([\w\.]+)/i',                          // KHTML/Tasman/Links
                '/(icab)[\/\s]([23]\.[\d\.]+)/i'                                      // iCab
            ], [self::NAME, self::VERSION], [

                '/rv\:([\w\.]{1,9}).+(gecko)/i'                                       // Gecko
            ], [self::VERSION, self::NAME]
        ];
    }
}
