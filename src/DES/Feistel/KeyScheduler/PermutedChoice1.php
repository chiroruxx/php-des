<?php

declare(strict_types=1);

namespace Chiroruxx\DES\DES\Feistel\KeyScheduler;

use Chiroruxx\DES\Element\BitArray;
use DomainException;

class PermutedChoice1
{
    public function __construct(private PermutedChoice1Left $left, private PermutedChoice1Right $right)
    {
        //
    }

    public function __invoke(BitArray $input): array
    {
        if ($input->getSize() !== 64) {
            throw new DomainException('PermutedChoice1 input should be in 64,bit.');
        }

        return [
            ($this->left)($input),
            ($this->right)($input)
        ];
    }
}
