<?php

declare(strict_types=1);

namespace Chiroruxx\DES\DES;

use Chiroruxx\DES\DES\Feistel\F\ExpansionFunction;
use Chiroruxx\DES\DES\Feistel\F\Permutation;
use Chiroruxx\DES\DES\Feistel\F\SubstitutionBoxList;
use Chiroruxx\DES\DES\Feistel\FeistelFunction;
use Chiroruxx\DES\DES\Feistel\FinalPermutation;
use Chiroruxx\DES\DES\Feistel\InitialPermutation;
use Chiroruxx\DES\DES\Feistel\KeyScheduler;
use Chiroruxx\DES\DES\Feistel\KeyScheduler\PermutedChoice1;
use Chiroruxx\DES\Element\Block;
use Chiroruxx\DES\Element\Key;

class DES
{
    private static ?Feistel $feistel = null;

    public static function encrypt(Block $block, Key $key): Block
    {
        if (self::$feistel === null) {
            self::$feistel = self::createFeistel();
        }

        return (self::$feistel)($block, self::createKeyScheduler($key));
    }

    private static function createFeistel(): Feistel
    {
        $ip = new InitialPermutation();

        $e = new ExpansionFunction();
        $s = new SubstitutionBoxList();
        $p = new Permutation();
        $f = new FeistelFunction($e, $s, $p);

        $fp = new FinalPermutation();

        return new Feistel($ip, $f, $fp);
    }

    private static function createKeyScheduler(Key $key): KeyScheduler
    {
        $pc1Left = new KeyScheduler\PermutedChoice1Left();
        $pc1Right = new KeyScheduler\PermutedChoice1Right();
        $pc1 = new PermutedChoice1($pc1Left, $pc1Right);

        $pc2 = new KeyScheduler\PermutedChoice2();

        return new KeyScheduler($key, $pc1, $pc2);
    }
}
