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
 *  @file AbstractDetector.php
 *
 *  The base class for detector
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
use Platine\UserAgent\Entity\Cpu;
use Platine\UserAgent\Entity\Device;
use Platine\UserAgent\Entity\Engine;
use Platine\UserAgent\Entity\Os;
use Platine\UserAgent\Util\Helper;

/**
 * Class AbstractDetector
 * @package Platine\UserAgent\Detector
 */
abstract class AbstractDetector
{
    /**
     * Data type and definitions
     */
    protected const NAME = 'name';
    protected const VERSION = 'version';
    protected const ARCHITECTURE = 'architecture';
    protected const MODEL = 'model';
    protected const VENDOR = 'vendor';
    protected const TYPE = 'type';
    protected const CONSOLE = 'console';
    protected const MOBILE = 'mobile';
    protected const TABLET = 'tablet';
    protected const SMART_TV = 'smart-tv';
    protected const WEARABLE = 'wearable';
    protected const UNKNOWN = '?';

    /**
     * The map for entity
     * @var array<string, mixed>
     */
    protected array $maps = [];

    /**
     * The entity regex pattern definition
     * @var array<array<string>>|array<array<array<string>>>
     */
    protected array $regex = [];

    /**
     * The current entity
     * @var Browser|Cpu|Os|Device|Engine
     */
    protected $entity;

    /**
     * Create new instance
     */
    public function __construct()
    {
        $this->maps = $this->maps();
        $this->regex = $this->regex();
    }

    /**
     * Detect the entity for the given user agent
     * @param string $userAgent
     * @return void
     */
    public function detect(string $userAgent): void
    {
        $regex = $this->regex();
        $regexLength = count($regex);
        $i = 0;
        $match = null;
        $matches = [];

        while ($i < $regexLength && ! $matches) {
            $reg = $regex[$i];
            $property = $regex[$i + 1];

            $j = 0;
            $k = 0;

            $regLength = count($reg);
            while ($j < $regLength && ! $matches) {
                $pattern = $reg[$j++];
                if (is_string($pattern)) {
                    preg_match($pattern, $userAgent, $matches);
                }

                if (count($matches) > 0) {
                    $lengthProperty = count($property);
                    for ($p = 0; $p < $lengthProperty; $p++) {
                        $q = $property[$p];
                        if (array_key_exists(++$k, $matches)) {
                            $match = $matches[$k];
                        }

                        if (is_array($q) && count($q) > 0) {
                            if (count($q) === 2) {
                                if (Helper::startsWith($q[1], '__')) {
                                    $functionName = Helper::replaceFirst('__', '', $q[1]);
                                    $result = null;
                                    if (method_exists($this, $functionName)) {
                                        $result = $this->{$functionName}($match);
                                    }
                                    $this->fillEntity([$q[0] => $result]);
                                } else {
                                    $this->fillEntity([$q[0] => $q[1]]);
                                }
                            } elseif (count($q) === 3) {
                                if (Helper::startsWith($q[1], '__')) {
                                    $functionName = Helper::replaceFirst('__', '', $q[1]);
                                    $args = explode('.', $q[2]);
                                    $argument = $this->maps();
                                    if (is_array($args)) {
                                        foreach ($args as $key) {
                                            $argument = $argument[$key];
                                        }
                                    }
                                    $result = null;
                                    if (method_exists($this, $functionName)) {
                                        $result = $this->{$functionName}($match, $argument);
                                    }
                                    $this->fillEntity([$q[0] => $result]);
                                } else {
                                    $replacedMatch = preg_replace($q[1], $q[2], $match);
                                    if ($replacedMatch !== null) {
                                        $this->fillEntity([$q[0] => $replacedMatch]);
                                    }
                                }
                            } elseif (count($q) === 4) {
                                if (Helper::startsWith($q[3], '__')) {
                                    $functionName = Helper::replaceFirst('__', '', $q[3]);
                                    $result = preg_replace($q[1], $q[2], $match);
                                    if (method_exists($this, $functionName)) {
                                        $result = $this->{$functionName}($result);
                                    }
                                    $this->fillEntity([$q[0] => $result]);
                                }
                            }
                        } else {
                            if (is_string($q)) {
                                $this->fillEntity([$q => $match]);
                            }
                        }
                    }
                }
            }
            $i += 2;
        }
    }

    /**
     * Return the entity instance
     * @return Browser|Cpu|Os|Device|Engine
     */
    public function entity()
    {
        return $this->entity;
    }

    /**
     * Return the entity map
     * @return array<string, mixed>
     */
    abstract public function maps(): array;

    /**
     * Return the entity regex pattern
     * @return array<array<string>>|array<array<array<string>>>
     */
    abstract public function regex(): array;

    /**
     * Fill the entity data
     * @param array<string, string|int> $data
     * @return void
     */
    protected function fillEntity(array $data): void
    {
        $this->entity->setData($data);
    }

    /**
     * Put the string to lower case
     * @param string $value
     * @return string
     */
    protected function lowerize(string $value): string
    {
        if (function_exists('mb_strtolower')) {
            return mb_strtolower($value);
        }

        return strtolower($value);
    }

    /**
     * Split version by DOT.
     * @param string $str
     * @return string|string[]|null
     */
    protected function trim(string $str)
    {
        return preg_replace(
            '/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/',
            '',
            $str
        );
    }

    /**
     * Replace given string using map data.
     * @param string $str
     * @param array<string, mixed> $maps
     * @return string|null
     */
    protected function str(string $str, array $maps): ?string
    {
        foreach ($maps as $key => $value) {
            if (is_array($value) && count($value) > 0) {
                $len = count($value);
                for ($i = 0; $i < $len; $i++) {
                    if (strpos($value[$i], $str) !== false) {
                        return $key === self::UNKNOWN ? null : (string) $key;
                    }
                }
            } elseif (strpos($value, $str) !== false) {
                return $key === self::UNKNOWN ? null : $key;
            }
        }

        return null;
    }
}
