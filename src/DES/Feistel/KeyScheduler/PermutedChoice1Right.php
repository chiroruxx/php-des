<?php

declare(strict_types=1);

namespace Chiroruxx\DES\DES\Feistel\KeyScheduler;

use Chiroruxx\DES\DES\Feistel\Permute;

class PermutedChoice1Right extends Permute
{
    protected const INPUT_SIZE = 64;
    protected const RULE = [
        63, 55, 47, 39, 31, 23, 15,
        7, 62, 54, 46, 38, 30, 22,
        14, 6, 61, 53, 45, 37, 29,
        21, 13, 5, 28, 20, 12, 4,
    ];
}
