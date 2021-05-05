<?php

declare(strict_types=1);

namespace Chiroruxx\DES\Test\Element;

use Chiroruxx\DES\Element\BitArray;
use PHPUnit\Framework\TestCase;

class BitArrayTest extends TestCase
{
    public function testConstruct()
    {
        $value = [1 => 0, 2 => 1];
        $array = new BitArray($value);
        $this->assertSame([0 => 0, 1 => 1], $array->toArray());
    }

    /**
     * @dataProvider dataOfCreateFromInt
     */
    public function testCreateFromInt(int $int, int $size, array $expected): void
    {
        $array = BitArray::createFromInt($int, $size);
        $this->assertSame($expected, $array->toArray());
    }

    public function dataOfCreateFromInt(): array
    {
        return [
            ['int' => 0, 'size' => 1, 'expected' => [0]],
            ['int' => 1, 'size' => 1, 'expected' => [1]],
            ['int' => 1, 'size' => 2, 'expected' => [0, 1]],
            ['int' => 2, 'size' => 2, 'expected' => [1, 0]],
        ];
    }

    /**
     * @dataProvider dataOfCreateFromSubsets
     */
    public function testCreateFromSubsets(array $subsets, array $expected): void
    {
        $array = BitArray::createFromSubsets($subsets);
        $this->assertSame($expected, $array->toArray());
    }

    public function dataOfCreateFromSubsets(): array
    {
        return [
            ['subsets' => [new BitArray([0])], 'expected' => [0]],
            ['subsets' => [new BitArray([0]), new BitArray([1])], 'expected' => [0, 1]],
            ['subsets' => [new BitArray([0]), new BitArray([1]), new BitArray([0])], 'expected' => [0, 1, 0]],
        ];
    }

    /**
     * @dataProvider dataOfMask
     */
    public function testMask(BitArray $array, BitArray $filter, array $expected): void
    {
        $this->assertSame($expected, $array->mask($filter)->toArray());
    }

    public function dataOfMask(): array
    {
        return [
            ['array' => new BitArray([1, 1]), 'filter' => new BitArray([0, 0]), 'expected' => [0, 0]],
            ['array' => new BitArray([1, 1]), 'filter' => new BitArray([0, 1]), 'expected' => [0, 1]],
            ['array' => new BitArray([1, 1]), 'filter' => new BitArray([1, 0]), 'expected' => [1, 0]],
            ['array' => new BitArray([1, 1]), 'filter' => new BitArray([1, 1]), 'expected' => [1, 1]],
            ['array' => new BitArray([0, 0]), 'filter' => new BitArray([1, 1]), 'expected' => [0, 0]],
        ];
    }

    /**
     * @dataProvider dataOfXor
     */
    public function testXor(BitArray $array, BitArray $other, array $expected): void
    {
        $this->assertSame($expected, $array->xor($other)->toArray());
    }

    public function dataOfXor(): array
    {
        return [
            ['array' => new BitArray([0]), 'other' => new BitArray([0]), 'expected' => [0]],
            ['array' => new BitArray([0]), 'other' => new BitArray([1]), 'expected' => [1]],
            ['array' => new BitArray([1]), 'other' => new BitArray([0]), 'expected' => [1]],
            ['array' => new BitArray([1]), 'other' => new BitArray([1]), 'expected' => [0]],
            ['array' => new BitArray([1, 1]), 'other' => new BitArray([1, 0]), 'expected' => [0, 1]],
        ];
    }

    public function testChunk(): void
    {
        $array = new BitArray([0, 0, 0, 0, 1, 1, 1, 1]);
        [$first, $last] = $array->chunk(4);

        $this->assertSame([0, 0, 0, 0], $first->toArray());
        $this->assertSame([1, 1, 1, 1], $last->toArray());
    }

    public function testChunkCount(): void
    {
        $array = new BitArray([0, 0, 0]);
        [$first, $last] = $array->chunk(2);

        $this->assertCount(2, $first->toArray());
        $this->assertCount(1, $last->toArray());
    }

    public function testShiftLeft(): void
    {
        $array = new BitArray([1, 0, 1]);
        $this->assertSame([0, 1, 1], $array->shiftLeft()->toArray());
    }

    /**
     * @dataProvider dataOfToInt
     */
    public function testToInt(BitArray $array, int $expected): void
    {
        $this->assertSame($expected, $array->toInt());
    }

    public function dataOfToInt(): array
    {
        return [
            ['array' => new BitArray([0]), 'expected' => 0],
            ['array' => new BitArray([1]), 'expected' => 1],
            ['array' => new BitArray([0, 0]), 'expected' => 0],
            ['array' => new BitArray([0, 1]), 'expected' => 1],
            ['array' => new BitArray([1, 0]), 'expected' => 2],
            ['array' => new BitArray([1, 1]), 'expected' => 3],
        ];
    }
}
