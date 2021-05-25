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
 *  @file OsDetector.php
 *
 *  The Operating System detector class
 *
 *  @package    Platine\UserAgent\Detector
 *  @author Platine Developers Team
 *  @copyright  Copyright (c) 2020
 *  @license    http://opensource.org/licenses/MIT  MIT License
 *  @link   http://www.iacademy.cf
 *  @version 1.0.0
 *  @filesource
 */

declare(strict_types=1);

namespace Platine\UserAgent\Detector;

use Platine\UserAgent\Entity\Os;

/**
 * Class OsDetector
 * @package Platine\UserAgent\Detector
 */
class OsDetector extends AbstractDetector
{

    /**
    * {@inheritdoc}
    */
    public function __construct()
    {
        parent::__construct();

        $this->entity = new Os();
    }


    /**
     * {@inheritdoc}
     */
    public function maps(): array
    {
        return [
            'windows' => [
                'versions' => [
                    'ME' => '4.90',
                    'NT 3.11' => 'NT3.51',
                    'NT 4.0' => 'NT4.0',
                    '2000' => 'NT 5.0',
                    'XP' => ['NT 5.1', 'NT 5.2'],
                    'Vista' => 'NT 6.0',
                    '7' => 'NT 6.1',
                    '8' => 'NT 6.2',
                    '8.1' => 'NT 6.3',
                    '10' => ['NT 6.4', 'NT 10.0'],
                    'RT' => 'ARM'
                ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function regex(): array
    {
        return [
            [

                // Windows based
                '/microsoft\s(windows)\s(vista|xp)/i'                                 // Windows (iTunes)
            ], [self::NAME, self::VERSION], [
                '/(windows)\snt\s6\.2;\s(arm)/i',                                     // Windows RT
                '/(windows\sphone(?:\sos)*)[\s\/]?([\d\.\s\w]*)/i',                   // Windows Phone
                '/(windows\smobile|windows)[\s\/]?([ntce\d\.\s]+\w)/i'
            ], [self::NAME, [self::VERSION, '__str', 'windows.versions']], [
                '/(win(?=3|9|n)|win\s9x\s)([nt\d\.]+)/i'
            ], [[self::NAME, 'Windows'], [self::VERSION, '__str', 'windows.version']], [

                // Mobile/Embedded OS
                '/\((bb)(10);/i'                                                      // BlackBerry 10
            ], [[self::NAME, 'BlackBerry'], self::VERSION], [
                '/(blackberry)\w*\/?([\w\.]*)/i',                                     // Blackberry
                '/(tizen)[\/\s]([\w\.]+)/i',                                          // Tizen
                '/(android|webos|palm\sos|qnx|bada|rim\stablet\sos|meego|sailfish|contiki)[\/\s-]?([\w\.]*)/i'
                // Android/WebOS/Palm/QNX/Bada/RIM/MeeGo/Contiki/Sailfish OS
            ], [self::NAME, self::VERSION], [
                '/(symbian\s?os|symbos|s60(?=;))[\/\s-]?([\w\.]*)/i'                  // Symbian
            ], [[self::NAME, 'Symbian'], self::VERSION], [
                '/\((series40);/i'                                                    // Series 40
            ], [self::NAME], [
                '/mozilla.+\(mobile;.+gecko.+firefox/i'                               // Firefox OS
            ], [[self::NAME, 'Firefox OS'], self::VERSION], [

                // Console
                '/(nintendo|playstation)\s([wids34portablevu]+)/i',                   // Nintendo/Playstation

                // GNU/Linux based
                '/(mint)[\/\s\(]?(\w*)/i',                                            // Mint
                '/(mageia|vectorlinux)[;\s]/i',                                       // Mageia/VectorLinux
                '/(joli|[kxln]?ubuntu|debian|suse|opensuse|gentoo|(?=\s)arch|slackware|fedora|mandriva|centos|pclinuxos|redhat|zenwalk|linpus)[\/\s-]?(?!chrom)([\w\.-]*)/i',
                // Joli/Ubuntu/Debian/SUSE/Gentoo/Arch/Slackware
                // Fedora/Mandriva/CentOS/PCLinuxOS/RedHat/Zenwalk/Linpus
                '/(hurd|linux)\s?([\w\.]*)/i',                                        // Hurd/Linux
                '/(gnu)\s?([\w\.]*)/i'                                                // GNU
            ], [self::NAME, self::VERSION], [

                '/(cros)\s[\w]+\s([\w\.]+\w)/i'                                       // Chromium OS
            ], [[self::NAME, 'Chromium OS'], self::VERSION], [

                // Solaris
                '/(sunos)\s?([\w\.\d]*)/i'                                            // Solaris
            ], [[self::NAME, 'Solaris'], self::VERSION], [

                // BSD based
                '/\s([frentopc-]{0,4}bsd|dragonfly)\s?([\w\.]*)/i'                    // FreeBSD/NetBSD/OpenBSD/PC-BSD/DragonFly
            ], [self::NAME, self::VERSION], [

                '/(haiku)\s(\w+)/i'                                                   // Haiku
            ], [self::NAME, self::VERSION], [

                '/cfnetwork\/.+darwin/i',
                '/ip[honead]{2,4}(?:.*os\s([\w]+)\slike\smac|;\sopera)/i'             // iOS
            ], [[self::VERSION, '/_/', '.'], [self::NAME, 'iOS']], [

                '/(mac\sos\sx)\s?([\w\s\.]*)/i',
                '/(macintosh|mac(?=_powerpc)\s)/i'                                    // Mac OS
            ], [[self::NAME, 'Mac OS'], [self::VERSION, '/_/', '.']], [

                // Other
                '/((?:open)?solaris)[\/\s-]?([\w\.]*)/i',                             // Solaris
                '/(aix)\s((\d)(?=\.|\)|\s)[\w\.])*/i',                                // AIX
                '/(plan\s9|minix|beos|os\/2|amigaos|morphos|risc\sos|openvms|fuchsia)/i',
                // Plan9/Minix/BeOS/OS2/AmigaOS/MorphOS/RISCOS/OpenVMS/Fuchsia
                '/(unix)\s?([\w\.]*)/i'                                               // UNIX
            ], [self::NAME, self::VERSION]
        ];
    }
}
