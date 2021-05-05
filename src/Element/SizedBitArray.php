<?php

declare(strict_types=1);

namespace Chiroruxx\DES\Element;

use DomainException;

/**
 * Fixed size BitArray.
 */
abstract class SizedBitArray extends BitArray
{
    protected const SIZE = 0;

    public function __construct(array $value)
    {
        parent::__construct($value);

        if ($this->getSize() !== static::SIZE) {
            $class = get_class($this);
            $size = static::SIZE;
            throw new DomainException("{$class} should be {$size} bit.");
        }
    }

    public static function createFromString(string $string): static
    {
        return self::createFromInt((int)bindec($string), static::SIZE);
    }
}
