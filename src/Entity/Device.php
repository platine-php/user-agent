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
 *  @file Device.php
 *
 *  The device entity class
 *
 *  @package    Platine\UserAgent\Entity
 *  @author Platine Developers Team
 *  @copyright  Copyright (c) 2020
 *  @license    http://opensource.org/licenses/MIT  MIT License
 *  @link   http://www.iacademy.cf
 *  @version 1.0.0
 *  @filesource
 */

declare(strict_types=1);

namespace Platine\UserAgent\Entity;

/**
 * Class Device
 * @package Platine\UserAgent\Entity
 */
class Device extends AbstractEntity
{

    /**
     * The device model
     * @var string
     */
    protected string $model = '';

    /**
     * The device vendor
     * @var string
     */
    protected string $vendor = '';

    /**
     * The type of device
     * @var string
     */
    protected string $type = '';

    /**
     * Return the model of device
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * Return the device vendor
     * @return string
     */
    public function getVendor(): string
    {
        return $this->vendor;
    }

    /**
     * Return the type of device
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the device model
     * @param string $model
     * @return $this
     */
    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Set the device vendor
     * @param string $vendor
     * @return $this
     */
    public function setVendor(string $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Set the device type
     * @param string $type
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * The string representation
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            '%s, %s %s',
            $this->model,
            $this->vendor,
            $this->type
        );
    }
}
