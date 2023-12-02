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
 *  @file CpuDetector.php
 *
 *  The CPU detector class
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

use Platine\UserAgent\Entity\Cpu;

/**
 * Class CpuDetector
 * @package Platine\UserAgent\Detector
 */
class CpuDetector extends AbstractDetector
{

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct();

        $this->entity = new Cpu();
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

                '/(?:(amd|x(?:(?:86|64)[_-])?|wow|win)64)[;\)]/i'                     // AMD64
            ], [[self::ARCHITECTURE, 'amd64']], [

                '/(ia32(?=;))/i'                                                      // IA32 (quicktime)
            ], [[self::ARCHITECTURE, '__lowerize']], [

                '/((?:i[346]|x)86)[;\)]/i'                                            // IA32
            ], [[self::ARCHITECTURE, 'ia32']], [

                // PocketPC mistakenly identified as PowerPC
                '/windows\s(ce|mobile);\sppc;/i'
            ], [[self::ARCHITECTURE, 'arm']], [

                '/((?:ppc|powerpc)(?:64)?)(?:\smac|;|\))/i'                           // PowerPC
            ], [[self::ARCHITECTURE, '/ower/', '', '__lowerize']], [

                '/(sun4\w)[;\)]/i'                                                    // SPARC
            ], [[self::ARCHITECTURE, 'sparc']], [

                '/((?:avr32|ia64(?=;))|68k(?=\))|arm(?:64|(?=v\d+[;l]))|(?=atmel\s)avr|(?:irix|mips|sparc)(?:64)?(?=;)|pa-risc)/i'
                // IA64, 68K, ARM/64, AVR/32, IRIX/64, MIPS/64, SPARC/64, PA-RISC
            ], [[self::ARCHITECTURE, '__lowerize']]
        ];
    }
}
