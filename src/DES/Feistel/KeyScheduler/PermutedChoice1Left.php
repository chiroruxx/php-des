<?php

declare(strict_types=1);

namespace Chiroruxx\DES\DES\Feistel\KeyScheduler;

use Chiroruxx\DES\DES\Feistel\Permute;

class PermutedChoice1Left extends Permute
{
    protected const INPUT_SIZE = 64;
    protected const RULE = [
        57, 49, 41, 33, 25, 17, 9,
        1,  58, 50, 42, 34, 26, 18,
        10, 2,  59, 51, 43, 35, 27,
        19, 11, 3,  60, 52, 44, 36,
    ];
}
