<?php

declare(strict_types=1);

namespace Chiroruxx\DES\DES\Feistel\F;

use Chiroruxx\DES\Element\BitArray;
use DomainException;

class SubstitutionBox
{
    public function __construct(private array $rule)
    {
        //
    }

    public function __invoke(BitArray $input): BitArray
    {
        if ($input->getSize() !== 6) {
            throw new DomainException('SubstitutionBox input should be 6 bit.');
        }

        $x = "{$input->get(0)}{$input->get(5)}";
        $y = "{$input->get(1)}{$input->get(2)}{$input->get(3)}{$input->get(4)}";

        return BitArray::createFromInt($this->rule[$x][$y], 4);
    }
}
