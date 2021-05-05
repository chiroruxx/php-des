<?php

declare(strict_types=1);

namespace Chiroruxx\DES\DES;

use Chiroruxx\DES\DES\Feistel\FeistelFunction;
use Chiroruxx\DES\DES\Feistel\FinalPermutation;
use Chiroruxx\DES\DES\Feistel\InitialPermutation;
use Chiroruxx\DES\DES\Feistel\KeyScheduler;
use Chiroruxx\DES\Element\BitArray;
use Chiroruxx\DES\Element\Block;

/**
 * Feistel structure.
 */
class Feistel
{
    private const ROUND_TIME = 16;

    public function __construct(
        private InitialPermutation $ip,
        private FeistelFunction $f,
        private FinalPermutation $fp,
    ) {
        //
    }

    public function __invoke(Block $block, KeyScheduler $keyScheduler): Block
    {
        $permutation = ($this->ip)($block);

        [$left, $right] = $permutation->chunk(32);

        for ($i = 0; $i < self::ROUND_TIME; $i++) {
            $subKey = $keyScheduler->getSubKey();
            $right = $left->xor(($this->f)($right, $subKey));
            $left = $right;
        }

        $result = ($this->fp)(BitArray::createFromSubsets([$left, $right]));
        return new Block($result->toArray());
    }
}
