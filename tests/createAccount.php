<?php

include "../src/ApiClient.php";

include "../src/models/request/account.inc";
include "../src/models/request/addon.inc";

if (!isset($argv[1]) || !isset($argv[2])) {
    exit("partnerId or apiKey is missing!");
}

$partnerId = $argv[1];
$apiKey = $argv[2];

//Declare Variables tp create new an account
$name = "ACME Inc";
$firstName = "Road";
$lastName = "Runner";
$email = "road.runner@yopmail.com";
$passwd = "TheSuperSecret";
$trialDays = 1;

//Create an Account Object
$objAccount = new Account($name, $firstName, $lastName, $email, $passwd, $trialDays);

//Add website add-on
$objAccount->addWebsiteAddon();

$apiClient = new ApiClient($partnerId, $apiKey);

try {
    $result = $apiClient->post("/account", $objAccount);

    //Print Result
    print_r ($result);
}
catch (Exception $e) {
    echo "Caught exception: ",  $e->getMessage(), "\n";
}
?>