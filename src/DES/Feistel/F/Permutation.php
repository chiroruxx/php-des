<?php

declare(strict_types=1);

namespace Chiroruxx\DES\DES\Feistel\F;

use Chiroruxx\DES\DES\Feistel\Permute;

class Permutation extends Permute
{
    protected const INPUT_SIZE = 32;
    protected const RULE = [
        16, 7,  20, 21, 29, 12, 28, 17,
        1,  15, 23, 26, 5,  18, 31, 10,
        2,  8,  24, 14, 32, 27, 3,  9,
        19, 13, 30, 6,  22, 11, 4,  25,
    ];
}
