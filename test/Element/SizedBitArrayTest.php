<?php

declare(strict_types=1);

namespace Chiroruxx\DES\Test\Element;

use Chiroruxx\DES\Element\SizedBitArray;
use DomainException;
use PHPUnit\Framework\TestCase;

class SizedBitArrayTest extends TestCase
{
    public function testConstruct()
    {
        $value = array_fill(0, 4, 1);
        $this->createMockedArray($value);
        $this->expectNotToPerformAssertions();
    }

    public function testConstructFailure()
    {
        $value = array_fill(0, 3, 1);
        $this->expectException(DomainException::class);
        $this->createMockedArray($value);
    }

    private function createMockedArray(array $value): void
    {
        new class($value) extends SizedBitArray {
            protected const SIZE = 4;
        };
    }
}
