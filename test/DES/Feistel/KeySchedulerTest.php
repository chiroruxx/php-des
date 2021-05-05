<?php

declare(strict_types=1);

namespace Chiroruxx\DES\Test\DES\Feistel;

use Chiroruxx\DES\DES\Feistel\KeyScheduler;
use Chiroruxx\DES\DES\Feistel\KeyScheduler\PermutedChoice1;
use Chiroruxx\DES\DES\Feistel\KeyScheduler\PermutedChoice2;
use Chiroruxx\DES\Element\BitArray;
use Chiroruxx\DES\Element\Key;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class KeySchedulerTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function testInvoke(): void
    {
        $key = Mockery::mock(Key::class);

        $pc1 = Mockery::mock(PermutedChoice1::class);
        $pc1->shouldReceive('__invoke')->andReturn([new BitArray([0, 0, 0, 1]), new BitArray([0, 0, 1, 0])]);

        $count = 0;
        $expected = [
            [0, 0, 1, 0, 0, 1, 0, 0],
            [0, 1, 0, 0, 1, 0, 0, 0],
        ];
        $pc2 = Mockery::mock(PermutedChoice2::class);
        $pc2->shouldReceive('__invoke')
            ->withArgs(function (mixed $arg) use ($expected, &$count): bool {
                return $arg instanceof BitArray and $arg->toArray() === $expected[$count++];
            })
            ->andReturn(new BitArray(array_fill(0, 48, 0)));

        $scheduler = new KeyScheduler($key, $pc1, $pc2);
        $scheduler->getSubKey();
        $scheduler->getSubKey();
    }
}
