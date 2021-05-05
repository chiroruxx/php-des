<?php

declare(strict_types=1);

namespace Chiroruxx\DES\DES\Feistel;

use Chiroruxx\DES\DES\Feistel\KeyScheduler\PermutedChoice1;
use Chiroruxx\DES\DES\Feistel\KeyScheduler\PermutedChoice2;
use Chiroruxx\DES\Element\BitArray;
use Chiroruxx\DES\Element\Key;

class KeyScheduler
{
    private BitArray $left;
    private BitArray $right;

    public function __construct(private Key $original, PermutedChoice1 $pc1, private PermutedChoice2 $pc2)
    {
        [$this->left, $this->right] = $pc1($this->original);
    }

    public function getSubKey(): SubKey
    {
        $this->left = $this->left->shiftLeft();
        $this->right = $this->right->shiftLeft();

        $result = ($this->pc2)(BitArray::createFromSubsets([$this->left, $this->right]));
        return new SubKey($result->toArray());
    }
}
