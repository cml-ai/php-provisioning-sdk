<?php

include "../src/ApiClient.php";

if (!isset($argv[1]) || !isset($argv[2])) {
    exit("partnerId or apiKey is missing!");
}

$partnerId = $argv[1];
$apiKey = $argv[2];

$apiClient = new ApiClient($partnerId, $apiKey);

try {
    $params = array(
        "start" => "1",
        "limit" => "2"
    );

    $result = $apiClient->get("/accounts", $params);

    //Print Result
    echo($result);
}
catch (Exception $e) {
    echo "Caught exception: ",  $e->getMessage(), "\n";
}
?>