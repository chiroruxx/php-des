<?php

declare(strict_types=1);

namespace Chiroruxx\DES\DES\Feistel;

use Chiroruxx\DES\Element\SizedBitArray;

class SubKey extends SizedBitArray
{
    protected const SIZE = 48;
}
