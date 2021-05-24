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
 *  @file UserAgent.php
 *
 *  The Platine User Agent main class
 *
 *  @package    Platine\UserAgent
 *  @author Platine Developers Team
 *  @copyright  Copyright (c) 2020
 *  @license    http://opensource.org/licenses/MIT  MIT License
 *  @link   http://www.iacademy.cf
 *  @version 1.0.0
 *  @filesource
 */

declare(strict_types=1);

namespace Platine\UserAgent;

use Platine\UserAgent\Detector\BrowserDetector;
use Platine\UserAgent\Detector\CpuDetector;
use Platine\UserAgent\Detector\DeviceDetector;
use Platine\UserAgent\Detector\EngineDetector;
use Platine\UserAgent\Detector\OsDetector;
use Platine\UserAgent\Entity\Browser;
use Platine\UserAgent\Entity\Cpu;
use Platine\UserAgent\Entity\Device;
use Platine\UserAgent\Entity\Engine;
use Platine\UserAgent\Entity\Os;

/**
 * Class UserAgent
 * @package Platine\UserAgent
 */
class UserAgent
{

    /**
     * Operating System detector
     * @var OsDetector
     */
    protected OsDetector $osDetector;

    /**
     * Device detector
     * @var DeviceDetector
     */
    protected DeviceDetector $deviceDetector;

    /**
     * Browser detector
     * @var BrowserDetector
     */
    protected BrowserDetector $browserDetector;

    /**
     * Engine detector
     * @var EngineDetector
     */
    protected EngineDetector $engineDetector;

    /**
     * CPU detector
     * @var CpuDetector
     */
    protected CpuDetector $cpuDetector;

    /**
     * Operating System entity
     * @var Os
     */
    protected Os $os;

    /**
     * Device entity
     * @var Device
     */
    protected Device $device;

    /**
     * Browser entity
     * @var Browser
     */
    protected Browser $browser;

    /**
     * Engine entity
     * @var Engine
     */
    protected Engine $engine;

    /**
     * CPU entity
     * @var Cpu
     */
    protected Cpu $cpu;

    /**
     * The User agent string
     * @var string
     */
    protected string $userAgent;

    /**
     * Create new instance
     * @param string|null $userAgent
     */
    public function __construct(?string $userAgent = null)
    {
        $this->browserDetector = new BrowserDetector();
        $this->cpuDetector = new CpuDetector();
        $this->engineDetector = new EngineDetector();
        $this->deviceDetector = new DeviceDetector();
        $this->osDetector = new OsDetector();

        if ($userAgent !== null) {
            $this->parse($userAgent);
        }
    }

    /**
     * Parse the user agent for the given value
     * @param string $userAgent
     * @return $this
     */
    public function parse(string $userAgent): self
    {
        $this->userAgent = $userAgent;

        $this->browser = $this->browserDetector->detect($this->userAgent);
        $this->cpu = $this->cpuDetector->detect($this->userAgent);
        $this->engine = $this->engineDetector->detect($this->userAgent);
        $this->device = $this->deviceDetector->detect($this->userAgent);
        $this->os = $this->osDetector->detect($this->userAgent);

        return $this;
    }

    /**
     * The Operating System entity
     * @return Os
     */
    public function os(): Os
    {
        return $this->os;
    }

    /**
     * The device entity
     * @return Device
     */
    public function device(): Device
    {
        return $this->device;
    }

    /**
     * The browser entity
     * @return Browser
     */
    public function browser(): Browser
    {
        return $this->browser;
    }

    /**
     * The engine entity
     * @return Engine
     */
    public function engine(): Engine
    {
        return $this->engine;
    }

    /**
     * The CPU entity
     * @return Cpu
     */
    public function cpu(): Cpu
    {
        return $this->cpu;
    }
}
