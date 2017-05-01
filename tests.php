<?php

// change the following paths if necessary
$yiit = __DIR__ . '/../../../../../yii-1.1.18.018a89/framework/yiit.php';
$config = __DIR__ . '/test_config.php';

require_once($yiit);
Yii::createWebApplication($config);

Yii::import("ext.ECCvalidator2.ECCValidator2");
$test = new ECCValidator2;

echo "Images can be found in: $test->assetsImages \n\n";

echo "Original ALL matching pattern:\n" . $test->patterns[ECCValidator2::ALL] . "\n\n";

// Test all supported formats as a custom pattern
$test->format = [
    ECCValidator2::MASTERCARD,
    ECCValidator2::VISA,
    ECCValidator2::AMERICAN_EXPRESS,
    ECCValidator2::DINERS_CLUB,
    ECCValidator2::DISCOVER,
    ECCValidator2::JCB,
    ECCValidator2::VOYAGER,
    ECCValidator2::SOLO,
    ECCValidator2::MAESTRO,
    ECCValidator2::SWITCH_CARD,
    ECCValidator2::ELECTRON,
    ECCValidator2::LASER,
];
$test->checkType();
echo "Resulting CUSTOM matching pattern:\n" . $test->patterns[ECCValidator2::CUSTOM] . "\n\n";

$testCardNumbers = [
    '371449635311004' => ECCValidator2::AMERICAN_EXPRESS,
    '373731623811006' => ECCValidator2::AMERICAN_EXPRESS,
    '378282246310005' => ECCValidator2::AMERICAN_EXPRESS,
    '371449635398431' => ECCValidator2::AMERICAN_EXPRESS,
    '378734493671000' => ECCValidator2::AMERICAN_EXPRESS,
    '345678000000007' => ECCValidator2::AMERICAN_EXPRESS,
    '4000000000000002' => ECCValidator2::VISA,
    '4444330322221117' => ECCValidator2::VISA,
    '4444333322221111' => ECCValidator2::VISA,
    '4012122222222226' => ECCValidator2::VISA,
    '4111111111111111' => ECCValidator2::VISA,
    '4012888888881881' => ECCValidator2::VISA,
    '4222222222222' => ECCValidator2::VISA,
    '5499830000000015' => ECCValidator2::MASTERCARD,
    '5499830000000031' => ECCValidator2::MASTERCARD,
    '5499830000000049' => ECCValidator2::MASTERCARD,
    '5555555555554444' => ECCValidator2::MASTERCARD,
    '5105105105105100' => ECCValidator2::MASTERCARD,
    'DC30125647382919' => ECCValidator2::DINERS_CLUB,
    'DC30129182736455' => ECCValidator2::DINERS_CLUB,
    'DC30121357924685' => ECCValidator2::DINERS_CLUB,
    '30569309025904' => ECCValidator2::DINERS_CLUB,
    '38520000023237' => ECCValidator2::DINERS_CLUB,
    '30569309025904' => ECCValidator2::DINERS_CLUB,
    '38520000023237' => ECCValidator2::DINERS_CLUB,
    '6011111111111117' => ECCValidator2::DISCOVER,
    '6011000990139424' => ECCValidator2::DISCOVER,
    '6759649826438453' => ECCValidator2::MAESTRO,
    '6799990100000000019' => ECCValidator2::MAESTRO,
    // Some wrong numbers
    '3852000BAU-BAU' => ECCValidator2::DINERS_CLUB,
    'abcdefghijklmn' => ECCValidator2::DINERS_CLUB,
];

$i = 1;
echo "Ultra fast Luhn number check tests. Last 2 cards should fail.\n";
foreach ($testCardNumbers as $cardNumber => $cardType) {
    echo "$i.\t" . ($test->luhnChk($cardNumber) === true ? "Passed: $cardNumber \t=> $cardType\n" : "PROBLEM!!! $cardNumber \t=> $cardType\n");
    $i++;
}

$i = 1;
echo "\nLuhn number check tests. Last 2 cards should fail.\n";
foreach ($testCardNumbers as $cardNumber => $cardType) {
    $test->format = $cardType;
    echo "$i.\t" . ($test->validateNumber($cardNumber) === true ? "Passed: $cardNumber \t=> $cardType\n" : "PROBLEM!!! $cardNumber \t=> $cardType\n");
    $i++;
}

$i = 1;
echo "\nCard type recognition tests. Last 2 cards should fail.\n";
foreach ($testCardNumbers as $cardNumber => $cardType) {
    echo "$i.\t" . ($test->cardType($cardNumber) === $cardType ? "Passed: $cardType\n" : "PROBLEM!!! Unknown card type!\n");
    $i++;
}
