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
 *  @file Helper.php
 *
 *  The User Agent helper class
 *
 *  @package    Platine\UserAgent\Util
 *  @author Platine Developers Team
 *  @copyright  Copyright (c) 2020
 *  @license    http://opensource.org/licenses/MIT  MIT License
 *  @link   https://www.platine-php.com
 *  @version 1.0.0
 *  @filesource
 */

declare(strict_types=1);

namespace Platine\UserAgent\Util;

/**
 * @class Helper
 * @package Platine\UserAgent\Util
 */
class Helper
{
    /**
     * Return the major version number from the full version
     * @param string $fullVersion
     * @return int
     */
    public static function getMajorVersion(string $fullVersion): int
    {
        $version = preg_replace('/[^\d\.]/', '', $fullVersion);
        if ($version !== null) {
            $parts = explode('.', $version);

            return (int) $parts[0];
        }
        return 0;
    }

    /**
     * Return the camel case value of the given string
     * @param string $value
     * @return string
     */
    public static function toCamelCase(string $value): string
    {
        return str_replace('_', '', lcfirst(ucwords($value, '_')));
    }

    /**
     * Check whether the string start with
     * @param string $str the string value
     * @param string $search the value to search
     * @return bool
     */
    public static function startsWith(string $str, string $search): bool
    {
        return strpos($str, $search) === 0;
    }

    /**
     * Replace the first matched of the string
     * @param string $search
     * @param string $replace
     * @param string $str
     * @return string
     */
    public static function replaceFirst(
        string $search,
        string $replace,
        string $str
    ): string {
        $regex = '/' . preg_quote($search, '/') . '/';
        $content = preg_replace($regex, $replace, $str, 1);

        if ($content !== null) {
            return $content;
        }

        return '';
    }
}
