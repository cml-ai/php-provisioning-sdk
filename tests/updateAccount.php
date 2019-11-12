<?php

include "../src/ApiClient.php";

include "../src/models/request/account.inc";
include "../src/models/request/addon.inc";

if (!isset($argv[1]) || !isset($argv[2]) || !isset($argv[3])) {
    exit("partnerId or apiKey or accountId is missing!");
}

$partnerId = $argv[1];
$apiKey = $argv[2];
$accountId = $argv[3];

$apiClient = new ApiClient($partnerId, $apiKey);

try {
	$objAccount = $apiClient->get("/account/" . $accountId, null);
	
	if (!is_null($objAccount) && isset($objAccount) && $objAccount->accountID == $accountId) {
		$objAccountUpdated = new Account("ACME Corp, Inc", $objAccount->firstName, $objAccount->lastName, $objAccount->email, null, $objAccount->trialDays);

		$result = $apiClient->put("/account/" . $objAccount->accountID, $objAccountUpdated);
		
    	//Print Result
    	print_r ($result);
	}
}
catch (Exception $e) {
    echo "Caught exception: ",  $e->getMessage(), "\n";
}
?>