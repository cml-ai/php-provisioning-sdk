# CML Provisioning SDK for PHP (v1)

This repository contains the open source PHP SDK that allows you to access the CML Provisioning API from your PHP app.

## Usage

> **Note:** This version of the CML Provisioning SDK for PHP requires PHP 5.4 or greater.

1. Get All Accounts
```php
$partnerId = $argv[1];
$apiKey = $argv[2];

$apiClient = new ApiClient($partnerId, $apiKey);

try {
    $params = array(
        "start" => "1",
        "limit" => "2"
    );

    $result = $apiClient->get("/accounts", $params);

    echo($result);
}
catch (Exception $e) {
    echo "Caught exception: ",  $e->getMessage(), "\n";
}
```

2. Get Single Account.

```php
$partnerId = $argv[1];
$apiKey = $argv[2];
$accountId = $argv[3];

$apiClient = new ApiClient($partnerId, $apiKey);

try {
    $result = $apiClient->get("/account/" . $accountId, null);
    
    echo($result);
}
catch (Exception $e) {
    echo "Caught exception: ",  $e->getMessage(), "\n";
}
```

Complete documentation and examples are available [here](https://docs.cml.ai/?version=latest).

## License

Please see the [license file](https://github.com/cml-ai/php-provisioning-sdk/blob/master/LICENSE.md) for more information.

## Security Vulnerabilities

If you have found a security issue, please contact the maintainers directly at [gaurang.jadia@mopro.com](mailto:gaurang.jadia@mopro.com).