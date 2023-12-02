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
 *  @file Cpu.php
 *
 *  The CPU entity class
 *
 *  @package    Platine\UserAgent\Entity
 *  @author Platine Developers Team
 *  @copyright  Copyright (c) 2020
 *  @license    http://opensource.org/licenses/MIT  MIT License
 *  @link   https://www.platine-php.com
 *  @version 1.0.0
 *  @filesource
 */

declare(strict_types=1);

namespace Platine\UserAgent\Entity;

/**
 * Class Cpu
 * @package Platine\UserAgent\Entity
 */
class Cpu extends AbstractEntity
{
    /**
     * The CPU architecture
     * @var string
     */
    protected string $architecture = '';

    /**
     * Get the architecture value
     * @return string
     */
    public function getArchitecture(): string
    {
        return $this->architecture;
    }

    /**
     * Set the architecture value
     * @param string $architecture
     * @return $this
     */
    public function setArchitecture(string $architecture): self
    {
        $this->architecture = $architecture;
        return $this;
    }

    /**
     * The string representation
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            '%s',
            $this->architecture
        );
    }
}
