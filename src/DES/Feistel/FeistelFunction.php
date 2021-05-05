<?php

declare(strict_types=1);

namespace Chiroruxx\DES\DES\Feistel;

use Chiroruxx\DES\DES\Feistel\F\ExpansionFunction;
use Chiroruxx\DES\DES\Feistel\F\Permutation;
use Chiroruxx\DES\DES\Feistel\F\SubstitutionBoxList;
use Chiroruxx\DES\Element\BitArray;
use DomainException;

class FeistelFunction
{
    public function __construct(private ExpansionFunction $e, private SubstitutionBoxList $sBox, private Permutation $p)
    {
        //
    }

    public function __invoke(BitArray $input, SubKey $key): BitArray
    {
        if ($input->getSize() !== 32) {
            throw new DomainException('F input should be 32 bit.');
        }

        $sBoxInput = ($this->e)($input)->xor($key);

        $pInput = ($this->sBox)($sBoxInput);

        return ($this->p)($pInput);
    }
}
