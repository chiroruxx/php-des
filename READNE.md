# Data Encryption Standard on PHP
## Usage

```php
<?php

declare(strict_types=1);

use Chiroruxx\DES\DES\DES;
use Chiroruxx\DES\Element\Block;
use Chiroruxx\DES\Element\Key;

require_once __DIR__ . '/vendor/autoload.php';

$plaintextString = str_repeat('10', 32);
$keyString = str_repeat('00001111', 8);

$block = Block::createFromString($plaintextString);
$key = Key::createFromString($keyString);

$cipherBlock = DES::encrypt($block, $key);
$cipherString = $cipherBlock->toString();

echo "Plaintext(block):  {$plaintextString}" . PHP_EOL;
echo "key:               {$keyString}" . PHP_EOL;
echo "Ciphertext(block): {$cipherString}" . PHP_EOL;

/*
 * Plaintext(block):  1010101010101010101010101010101010101010101010101010101010101010
 * key:               0000111100001111000011110000111100001111000011110000111100001111
 * Ciphertext(block): 1111001100000000110011110000000011001100111111001111000011111111
 */
```
