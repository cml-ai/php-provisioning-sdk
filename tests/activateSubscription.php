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
	$result = $apiClient->put("/account/" . $accountId . "/subscribe", new stdClass());	//need to send empty object to PUT method
	
    //Print Result
    print_r ($result);
}
catch (Exception $e) {
    echo "Caught exception: ",  $e->getMessage(), "\n";
}

?>