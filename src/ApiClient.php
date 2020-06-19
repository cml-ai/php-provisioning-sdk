<?php

class ApiClient {
    var $apiUrl;
    var $partnerId;
    var $apiKey;

    function __construct($partnerId, $apiKey) {
        $this->partnerId = $partnerId;
        $this->apiKey = $apiKey;

        $this->apiUrl = "https://api.cml.ai/v1/partner/" . $this->partnerId;
    }

    public function get($urlSuffix, $data) {
        return $this->makeRequest("GET", $urlSuffix, $data);
    }

    public function post($urlSuffix, $data) {
        return $this->makeRequest("POST", $urlSuffix, $data);
    }

    public function put($urlSuffix, $data) {
        return $this->makeRequest("PUT", $urlSuffix, $data);
    }

    public function delete($urlSuffix, $data) {
        return $this->makeRequest("DELETE", $urlSuffix, $data);
    }

    private function makeRequest($method, $urlSuffix, $data) {
        $url = $this->apiUrl . $urlSuffix;
        
        if ($method == "GET" && !is_null($data)) {
            $url .= "?" . http_build_query($data, '', "&");
        }

        //create a new cURL resource
        $ch = curl_init($url);
        
        //set UserAgent
        curl_setopt($ch, CURLOPT_USERAGENT, "CML Provisioning SDK PHP Client v1.0.0.0");

        //request headers
        $headers = array(
            "X-Api-Key:" . $this->apiKey
        );

        //return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //don't verify the peer's SSL certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        if ($method == "POST") {
            if ($data != null) {
                //setup request to send json via POST
                $payload = json_encode($data);

                //attach encoded JSON string to the POST fields
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

                //add contentType of headers array
                array_push($headers, "Content-Type:application/json");
            }
        }
        else if ($method == "PUT") {
            if ($data != null) {
                //setup request to send json via POST
                $payload = json_encode($data);

                //attach encoded JSON string to the POST fields
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);    
            }
            
            //add contentType of headers array
            array_push($headers, "Content-Type:application/json");

            //request method = PUT
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        }
        else if ($method == "DELETE") {
            //request method = DELETE
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        //set request headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        //execute the request
        $result = curl_exec($ch);

        //to help debug request
        $info = curl_getinfo($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        //close cURL resource
        curl_close($ch);

        if (isset($error_msg)) {
            throw new Exception($error_msg);
        }
        else {
            $response = json_decode($result);
            
            if ($response->status == 200) {
                if (!is_null($response) && isset($response) && property_exists($response, "data") && !empty((array)$response->data)) {
                    return $response->data;
                }
                else {
                    return true;
                }
            }
            else {
                throw new Exception($response->error->name . " : " . $response->error->message);
            }
        }
    }
}
?>