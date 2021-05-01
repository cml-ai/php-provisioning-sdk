<?php

include "../src/ApiClient.php";

if (!isset($argv[1]) || !isset($argv[2]) || !isset($argv[3])) {
    exit("partnerId or apiKey or accountId is missing!");
}

$partnerId = $argv[1];
$apiKey = $argv[2];
$accountId = $argv[3];

$apiClient = new ApiClient($partnerId, $apiKey);

try {
	$params = array(
        "expiresIn" => "432000",
    );

    $result = $apiClient->get("/account/" . $accountId . "/login", $params);

    // ContinueUrl can be used to open DCC (Digital Command Center)
    echo $result->continueUrl;
    
    //Print Result
    //print_r ($result);
}
catch (Exception $e) {
    echo "Caught exception: ",  $e->getMessage(), "\n";
}
?>