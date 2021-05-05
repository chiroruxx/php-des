<?php

declare(strict_types=1);

namespace Chiroruxx\DES\Element;

/**
 * Encryption key.
 */
class Key extends SizedBitArray
{
    protected const SIZE = 64;
}
