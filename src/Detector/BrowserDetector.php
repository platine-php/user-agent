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
 *  @file BrowserDetector.php
 *
 *  The browser detector class
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

use Platine\UserAgent\Entity\Browser;

/**
 * @class BrowserDetector
 * @package Platine\UserAgent\Detector
 */
class BrowserDetector extends AbstractDetector
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct();

        $this->entity = new Browser();
    }

    /**
     * {@inheritdoc}
     */
    public function maps(): array
    {
        return [
            'oldsafari' => [
                'version' => [
                    '1.0' => '/8',
                    '1.2' => '/1',
                    '1.3' => '/3',
                    '2.0' => '/412',
                    '2.0.2' => '/416',
                    '2.0.3' => '/417',
                    '2.0.4' => '/419',
                    '?' => '/'
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
                // Presto based
                '/(opera\smini)\/([\w\.-]+)/i',                                       // Opera Mini
                '/(opera\s[mobiletab]+).+version\/([\w\.-]+)/i',                      // Opera Mobi/Tablet
                '/(opera).+version\/([\w\.]+)/i',                                     // Opera > 9.80
                '/(opera)[\/\s]+([\w\.]+)/i'                                          // Opera < 9.80
            ], [self::NAME, self::VERSION], [
                '/(opios)[\/\s]+([\w\.]+)/i'                                        // Opera mini on iphone >= 8.0
            ], [[self::NAME, 'Opera Mini'], self::VERSION], [
                '/\s(opr)\/([\w\.]+)/i'                                              // Opera Webkit
            ], [[self::NAME, 'Opera'], self::VERSION], [
                // Mixed
                '/(kindle)\/([\w\.]+)/i',                                             // Kindle
                '/(lunascape|maxthon|netfront|jasmine|blazer)[\/\s]?([\w\.]*)/i',
                // Lunascape/Maxthon/Netfront/Jasmine/Blazer

                // Trident based
                '/(avant\s|iemobile|slim|baidu)(?:browser)?[\/\s]?([\w\.]*)/i',
                // Avant/IEMobile/SlimBrowser/Baidu
                '/(?:ms|\()(ie)\s([\w\.]+)/i',                                        // Internet Explorer

                // Webkit/KHTML based
                '/(rekonq)\/([\w\.]*)/i',                                             // Rekonq
                '/(Instagram)\s([\w\.]+)/i',                                               // Instagram inApp Browser
                '/(chromium|flock|rockmelt|midori|epiphany|silk|skyfire|ovibrowser|bolt|iron|vivaldi|iridium|phantomjs|bowser|quark|qupzilla|falkon)\/([\w\.-]+)/i'
                // Chromium/Flock/RockMelt/Midori/Epiphany/Silk/Skyfire/Bolt/Iron/Iridium/PhantomJS/Bowser/QupZilla/Falkon
            ], [self::NAME, self::VERSION], [
                '/(konqueror)\/([\w\.]+)/i'                                           // Konqueror
            ], [[self::NAME, 'Konqueror'], self::VERSION], [
                '/(trident).+rv[:\s]([\w\.]+).+like\sgecko/i'                         // IE11
            ], [[self::NAME, 'IE'], self::VERSION], [
                '/(edge|edgios|edga|edg)\/((\d+)?[\w\.]+)/i'                         // Microsoft Edge
            ], [[self::NAME, 'Edge'], self::VERSION], [
                '/(yabrowser)\/([\w\.]+)/i'                                           // Yandex
            ], [[self::NAME, 'Yandex'], self::VERSION], [
                '/(puffin)\/([\w\.]+)/i'                                              // Puffin
            ], [[self::NAME, 'Puffin'], self::VERSION], [

                '/(focus)\/([\w\.]+)/i'                                               // Firefox Focus
            ], [[self::NAME, 'Firefox Focus'], self::VERSION], [

                '/(opt)\/([\w\.]+)/i'                                                 // Opera Touch
            ], [[self::NAME, 'Opera Touch'], self::VERSION], [

                '/((?:[\s\/])uc?\s?browser|(?:juc.+)ucweb)[\/\s]?([\w\.]+)/i'         // UCBrowser
            ], [[self::NAME, 'UCBrowser'], self::VERSION], [

                '/(comodo_dragon)\/([\w\.]+)/i'                                       // Comodo Dragon
            ], [[self::NAME, '/_/g', ' '], self::VERSION], [

                '/(windowswechat qbcore)\/([\w\.]+)/i'                                // WeChat Desktop for Windows Built-in Browser
            ], [[self::NAME, 'WeChat(Win) Desktop'], self::VERSION], [

                '/(micromessenger)\/([\w\.]+)/i'                                      // WeChat
            ], [[self::NAME, 'WeChat'], self::VERSION], [

                '/(brave)\/([\w\.]+)/i'                                              // Brave browser
            ], [[self::NAME, 'Brave'], self::VERSION], [

                '/(qqbrowserlite)\/([\w\.]+)/i'                                       // QQBrowserLite
            ], [self::NAME, self::VERSION], [

                '/(QQ)\/([\d\.]+)/i'                                                  // QQ, aka ShouQ
            ], [self::NAME, self::VERSION], [

                '/m?(qqbrowser)[\/\s]?([\w\.]+)/i'                                    // QQBrowser
            ], [self::NAME, self::VERSION], [

                '/(BIDUBrowser)[\/\s]?([\w\.]+)/i'                                    // Baidu Browser
            ], [self::NAME, self::VERSION], [

                '/(2345Explorer)[\/\s]?([\w\.]+)/i'                                   // 2345 Browser
            ], [self::NAME, self::VERSION], [

                '/(MetaSr)[\/\s]?([\w\.]+)/i'                                         // SouGouBrowser
            ], [self::NAME], [

                '/(LBBROWSER)/i'                                      // LieBao Browser
            ], [self::NAME], [

                '/xiaomi\/miuibrowser\/([\w\.]+)/i'                                   // MIUI Browser
            ], [self::VERSION, [self::NAME, 'MIUI Browser']], [

                '/;(fbav)\/([\w\.]+);/i'                                                // Facebook App for iOS & Android
            ], [[self::NAME, 'Facebook'], self::VERSION], [

                '/safari\s(line)\/([\w\.]+)/i',                                       // Line App for iOS
                '/android.+(line)\/([\w\.]+)\/iab/i'                                  // Line App for Android
            ], [self::NAME, self::VERSION], [

                '/headlesschrome(?:\/([\w\.]+)|\s)/i'                                 // Chrome Headless
            ], [self::VERSION, [self::NAME, 'Chrome Headless']], [

                '/\swv\).+(chrome)\/([\w\.]+)/i'                                      // Chrome WebView
            ], [[self::NAME, '/(.+)/', '$1 WebView'], self::VERSION], [

                '/((?:oculus|samsung)browser)\/([\w\.]+)/i'
            ], [[self::NAME, "/(.+(?:g|us))(.+)/", '$1 $2'], self::VERSION], [                // Oculus / Samsung Browser

                '/android.+version\/([\w\.]+)\s+(?:mobile\s?safari|safari)*/i'        // Android Browser
            ], [self::VERSION, [self::NAME, 'Android Browser']], [

                '/(sailfishbrowser)\/([\w\.]+)/i'                                     // Sailfish Browser
            ], [[self::NAME, 'Sailfish Browser'], self::VERSION], [

                '/(chrome|omniweb|arora|[tizenoka]{5}\s?browser)\/v?([\w\.]+)/i'
                // Chrome/OmniWeb/Arora/Tizen/Nokia
            ], [self::NAME, self::VERSION], [

                '/(dolfin)\/([\w\.]+)/i'                                              // Dolphin
            ], [[self::NAME, 'Dolphin'], self::VERSION], [

                '/((?:android.+)crmo|crios)\/([\w\.]+)/i'                             // Chrome for Android/iOS
            ], [[self::NAME, 'Chrome'], self::VERSION], [

                '/(coast)\/([\w\.]+)/i'                                               // Opera Coast
            ], [[self::NAME, 'Opera Coast'], self::VERSION], [

                '/fxios\/([\w\.-]+)/i'                                                // Firefox for iOS
            ], [self::VERSION, [self::NAME, 'Firefox']], [

                '/version\/([\w\.]+).+?mobile\/\w+\s(safari)/i'                       // Mobile Safari
            ], [self::VERSION, [self::NAME, 'Mobile Safari']], [

                '/version\/([\w\.]+).+?(mobile\s?safari|safari)/i'                    // Safari & Safari Mobile
            ], [self::VERSION, self::NAME], [

                '/webkit.+?(gsa)\/([\w\.]+).+?(mobile\s?safari|safari)(\/[\w\.]+)/i'  // Google Search Appliance on iOS
            ], [[self::NAME, 'GSA'], self::VERSION], [

                '/webkit.+?(mobile\s?safari|safari)(\/[\w]+)/i'                     // Safari < 3.0
            ], [self::NAME, [self::VERSION, '__str', 'oldsafari.version']], [

                '/(webkit|khtml)\/([\w\.]+)/i'
            ], [self::NAME, self::VERSION], [

                // Gecko based
                '/(navigator|netscape)\/([\w\.-]+)/i'                                 // Netscape
            ], [[self::NAME, 'Netscape'], self::VERSION], [
                '/(swiftfox)/i',                                                      // Swiftfox
                '/(icedragon|iceweasel|camino|chimera|fennec|maemo\sbrowser|minimo|conkeror)[\/\s]?([\w\.\+]+)/i',
                // IceDragon/Iceweasel/Camino/Chimera/Fennec/Maemo/Minimo/Conkeror
                '/(firefox|seamonkey|k-meleon|icecat|iceape|firebird|phoenix|palemoon|basilisk|waterfox)\/([\w\.-]+)$/i',

                // Firefox/SeaMonkey/K-Meleon/IceCat/IceApe/Firebird/Phoenix
                '/(mozilla)\/([\w\.]+).+rv\:.+gecko\/\d+/i',                          // Mozilla

                // Other
                '/(polaris|lynx|dillo|icab|doris|amaya|w3m|netsurf|sleipnir)[\/\s]?([\w\.]+)/i',
                // Polaris/Lynx/Dillo/iCab/Doris/Amaya/w3m/NetSurf/Sleipnir
                '/(links)\s\(([\w\.]+)/i',                                            // Links
                '/(gobrowser)\/?([\w\.]*)/i',                                         // GoBrowser
                '/(ice\s?browser)\/v?([\w\._]+)/i',                                   // ICE Browser
                '/(mosaic)[\/\s]([\w\.]+)/i'                                          // Mosaic
            ], [self::NAME, self::VERSION],
        ];
    }
}
