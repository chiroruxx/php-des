<?php

declare(strict_types=1);

namespace Chiroruxx\DES\Test\DES\Feistel;

use Chiroruxx\DES\DES\Feistel\Permute;
use Chiroruxx\DES\Element\BitArray;
use PHPUnit\Framework\TestCase;

class PermuteTest extends TestCase
{
    public function testInvoke(): void
    {
        $array = new BitArray([0, 1, 0, 1]);
        $permute = $this->createMockPermute();

        $this->assertSame([1, 1, 0], $permute($array)->toArray());
    }

    public function createMockPermute(): Permute
    {
        return new class extends Permute {
            protected const INPUT_SIZE = 4;
            protected const RULE = [3, 1, 2];
        };
    }
}
