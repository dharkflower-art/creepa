<?php

list($preChars, $startChars, $middleVowels, $endChars, $extraChars) = require_once('lib_v1.php');

$totalWordOutput = 20;
$preDenominator = 4;
$extraDenominator = 4;

$basicInRowMax = 3;
$basicInRowCount = 0;
$forceNotBasic = FALSE;

for($i=0; $i<$totalWordOutput; $i++) {
    $word = '';
    $basic = TRUE;

    // pre
    if(rand(1, $preDenominator) === $preDenominator || $forceNotBasic) {
        $word .= $preChars[array_rand($preChars)] . 'a';
        $basic = FALSE;

        if($forceNotBasic && rand(0, 1)) {
            $forceNotBasic = FALSE;
            $basicInRowCount = 0;
        }
    }

    // start char
    $word .= $startChars[array_rand($startChars)];

    // middle vowels
    $word .= $middleVowels[array_rand($middleVowels)];

    // end char
    $word .= $endChars[array_rand($endChars)];

    // extra chars
    if(rand(1, $extraDenominator) === $extraDenominator || $forceNotBasic) {
        $word .= $extraChars[array_rand($extraChars)];
        $basic = FALSE;

        if($forceNotBasic) {
            $forceNotBasic = FALSE;
            $basicInRowCount = 0;
        }
    }

    if($basic) {
        if($basicInRowCount === $basicInRowMax) {
            $i--;
            $forceNotBasic = TRUE;
            continue;
        }

        $basicInRowCount++;
    }

    echo $word . ' ';
}

echo "\n\n";