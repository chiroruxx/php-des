<?php

declare(strict_types=1);

namespace Chiroruxx\DES\Element;

use DomainException;

/**
 * Array structure from some bits.
 */
class BitArray
{
    private array $value;

    public function __construct(array $value)
    {
        foreach ($value as $element) {
            if (!in_array($element, [0, 1], true)) {
                throw new DomainException('each element of BitArray should be 0 or 1.');
            }
        }

        $this->value = array_values($value);
    }

    /**
     * Create a BitArray from integer.
     *
     * @param int $int
     * @param int $size Size of array.
     * @return static
     */
    public static function createFromInt(int $int, int $size): static
    {
        if ($size < 1) {
            throw new DomainException("BitArray size should be grater than 0");
        }

        $string = sprintf("%0{$size}b", $int);
        $array = str_split($string);

        return new static(array_map(fn(string $str): int => (int)$str, $array));
    }

    /**
     * Create a BitArray from BitArray list.
     *
     * @param BitArray[] $subsets
     * @return self
     */
    public static function createFromSubsets(array $subsets): self
    {
        $base = array_shift($subsets)->toArray();
        foreach ($subsets as $subset) {
            $base = array_merge($base, $subset->toArray());
        }

        return new static($base);
    }

    /**
     * Get an element of this array.
     *
     * @param int $index
     * @return int
     */
    public function get(int $index): int
    {
        return $this->value[$index];
    }

    /**
     * Get size of this array.
     *
     * @return int
     */
    public function getSize(): int
    {
        return count($this->value);
    }

    /**
     * Mask by a filter.
     *
     * @param self $filter
     * @return self
     */
    public function mask(self $filter): self
    {
        if ($this->getSize() !== $filter->getSize()) {
            throw new DomainException('Invalid array size.');
        }

        return static::createFromInt($this->toInt() & $filter->toInt(), $this->getSize());
    }

    /**
     * Calculate xor.
     *
     * @param self $other
     * @return self
     */
    public function xor(self $other): self
    {
        if ($this->getSize() !== $other->getSize()) {
            throw new DomainException('Invalid array size.');
        }

        return static::createFromInt($this->toInt() ^ $other->toInt(), $this->getSize());
    }

    /**
     * Split to same size arrays.
     *
     * @param int $length
     * @return self[]
     */
    public function chunk(int $length): array
    {
        $chunked = array_chunk($this->value, $length);

        return array_map(fn(array $subset): self => new self($subset), $chunked);
    }

    /**
     * Shift 1bit to left.
     *
     * @return self
     */
    public function shiftLeft(): self
    {
        $value = $this->value;
        $first = array_shift($value);
        $value[] = $first;

        return new static($value);
    }

    /**
     * Convert to string.
     *
     * @return string
     */
    public function toString(): string
    {
        return implode('', $this->value);
    }

    /**
     * Convert to integer.
     *
     * @return int
     */
    public function toInt(): int
    {
        return intval($this->toString(), 2);
    }

    /**
     * Export the value.
     *
     * @return int[]
     */
    public function toArray(): array
    {
        return $this->value;
    }
}
