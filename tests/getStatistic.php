<?php

include "../src/ApiClient.php";

if (!isset($argv[1]) || !isset($argv[2])) {
    exit("partnerId or apiKey is missing!");
}

$partnerId = $argv[1];
$apiKey = $argv[2];

$apiClient = new ApiClient($partnerId, $apiKey);

try {
    $result = $apiClient->get("/accounts/statistic", null);

    //Print Result
    print_r ($result);
}
catch (Exception $e) {
    echo "Caught exception: ",  $e->getMessage(), "\n";
}
?>