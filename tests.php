<?php

// change the following paths if necessary
$yiit = __DIR__ . '/../../../../../yii-1.1.15.022a51/framework/yiit.php';
$config = __DIR__ . '/test_config.php';

require_once($yiit);
Yii::createWebApplication($config);

Yii::import("ext.ECCvalidator2.ECCValidator2");
$test = new ECCValidator2;
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
    '4000000000000002' => ECCValidator2::VISA,
    '4444330322221117' => ECCValidator2::VISA,
    '4444333322221111' => ECCValidator2::VISA,
    '4012122222222226' => ECCValidator2::VISA,
    '5499830000000015' => ECCValidator2::MASTERCARD,
    '5499830000000031' => ECCValidator2::MASTERCARD,
    '5499830000000049' => ECCValidator2::MASTERCARD,    
    'DC30125647382919' => ECCValidator2::DINERS_CLUB,
    'DC30129182736455' => ECCValidator2::DINERS_CLUB,
    'DC30121357924685' => ECCValidator2::DINERS_CLUB,
    
];

$i=1;
echo "Luhn number check tests:\n";
foreach ($testCardNumbers as $cardNumber => $cardType) {
    $test->format = $cardType;
    echo "$i.\t" . ($test->validateNumber($cardNumber) === true ? "Passed: $cardNumber \t=> $cardType\n" : "Problem $cardNumber \t=> $cardType\n");
    $i++;
}

$i=1;
echo "\nCard type recognition tests:\n";
foreach ($testCardNumbers as $cardNumber => $cardType) {
    echo "$i.\t" . ($test->cardType($cardNumber) === $cardType ? "Passed: $cardType\n" : "Problem: $cardType\n");
    $i++;
}

//print_r($test);
