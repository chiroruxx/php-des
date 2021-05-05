<?php

declare(strict_types=1);

namespace Chiroruxx\DES\DES\Feistel\F;

use Chiroruxx\DES\DES\Feistel\Permute;

class ExpansionFunction extends Permute
{
    protected const INPUT_SIZE = 32;
    protected const RULE = [
        32,  1,   2,   3,   4,   5,
        4,   5,   6,   7,   8,   9,
        8,   9,   10,  11,  12,  13,
        12,  13,  14,  15,  16,  17,
        16,  17,  18,  19,  20,  21,
        20,  21,  22,  23,  24,  25,
        24,  25,  26,  27,  28,  29,
        28,  29,  30,  31,  32,  1,
    ];
}
