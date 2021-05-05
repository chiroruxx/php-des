<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$plainTextString = str_repeat('10', 32);
$keyString = str_repeat('01', 32);

$block = \Chiroruxx\DES\Element\Block::createFromString($plainTextString);
$key = \Chiroruxx\DES\Element\Key::createFromString($keyString);

$cipherBlock = \Chiroruxx\DES\DES\DES::encrypt($block, $key);
$cipher = $cipherBlock->toString();

echo "Plaintext(block):  {$plainTextString}" . PHP_EOL;
echo "key:               {$keyString}" . PHP_EOL;
echo "Ciphertext(block): {$cipher}" . PHP_EOL;

/*
 * Plaintext(block):  1010101010101010101010101010101010101010101010101010101010101010
 * key:               0101010101010101010101010101010101010101010101010101010101010101
 * Ciphertext(block): 0011111111111111001100111111111111000011110000001100111100000000
 */
