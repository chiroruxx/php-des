<?php

declare(strict_types=1);

namespace Chiroruxx\DES\DES\Feistel;

use Chiroruxx\DES\Element\BitArray;
use DomainException;

/**
 * Permute elements of BitArray.
 */
abstract class Permute
{
    protected const INPUT_SIZE = 0;
    protected const RULE = [];

    public function __invoke(BitArray $input): BitArray
    {
        if ($input->getSize() !== static::INPUT_SIZE) {
            $class = get_class($this);
            $size = static::INPUT_SIZE;
            throw new DomainException("{$class} input should be {$size} bit.");
        }

        $result = [];
        foreach (static::RULE as $index) {
            $result[] = $input->get($index - 1);
        }

        return new BitArray($result);
    }
}
