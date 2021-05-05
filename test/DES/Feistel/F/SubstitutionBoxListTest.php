<?php

declare(strict_types=1);

namespace Chiroruxx\DES\Test\DES\Feistel\F;

use Chiroruxx\DES\DES\Feistel\F\SubstitutionBoxList;
use Chiroruxx\DES\Element\BitArray;
use PHPUnit\Framework\TestCase;

class SubstitutionBoxListTest extends TestCase
{
    public function testInvoke(): void
    {
        $inputArray = [];
        for ($i = 0; $i < 8; $i++) {
            $inputArray[] = 1;
            $inputArray[] = 0;
            $inputArray[] = 0;
            $inputArray[] = 0;
            $inputArray[] = 0;
            $inputArray[] = 1;
        }
        $input = new BitArray($inputArray);

        $list = new SubstitutionBoxList();

        $eachExpected = [
            decbin(15),
            decbin(13),
            decbin(1),
            decbin(3),
            decbin(11),
            decbin(4),
            decbin(6),
            decbin(2),
        ];
        $eachExpected = array_map(fn (string $item): string => sprintf('%04d', $item), $eachExpected);
        $expectedString = str_split(implode('', $eachExpected));
        $expected = array_map('intval', $expectedString);
        $this->assertSame($expected, $list($input)->toArray());
    }
}
