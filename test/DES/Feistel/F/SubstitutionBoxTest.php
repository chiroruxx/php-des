<?php

declare(strict_types=1);

namespace Chiroruxx\DES\Test\DES\Feistel\F;

use Chiroruxx\DES\DES\Feistel\F\SubstitutionBox;
use Chiroruxx\DES\Element\BitArray;
use PHPUnit\Framework\TestCase;

class SubstitutionBoxTest extends TestCase
{
    public function testInvoke(): void
    {
        $input = new BitArray([0, 1, 1, 1, 1, 0]);

        $rule = ['00' => ['1111' => 1]];

        $sBox = new SubstitutionBox($rule);

        $this->assertSame([0, 0, 0, 1], $sBox($input)->toArray());
    }
}
