<?php

declare(strict_types=1);

namespace Chiroruxx\DES\Element;

/**
 * A part of plaintext.
 */
class Block extends SizedBitArray
{
    protected const SIZE = 64;
}
