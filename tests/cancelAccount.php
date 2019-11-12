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
    $result = $apiClient->delete("/account/" . $accountId, null);

    //Print Result
    print_r ($result);
}
catch (Exception $e) {
    echo "Caught exception: ",  $e->getMessage(), "\n";
}

?>