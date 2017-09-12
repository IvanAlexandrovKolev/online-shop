<?php
class NikiApi {
    private $apiId,
        $apiSecret,
        $host = "http://niki.urandeals.eu";

    function __construct($apiId, $apiSecret)
    {
        $this->apiId = $apiId;
        $this->apiSecret = $apiSecret;
    }

    private function sendRequest($url, $dataArray)
    {
        $dataArray["time"] = time();
        $accessToken = $this->createAccessToken($dataArray);
        $dataArray['apiId'] = $this->apiId;
        $dataArray['accessToken'] = $accessToken;

        $postData = http_build_query($dataArray);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded; charset=utf-8'
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);
        if(curl_error($ch))
        {
            return 'Error:' . curl_error($ch);
            die;
        }

        curl_close ($ch);
        return $server_output;
    }

    private function createAccessToken($data)
    {
        $token = $this->apiId;
        foreach($data as $key=>$val) {
            $keyLen = strlen($key);
            $valLen = strlen($val);
            $res = $keyLen * $valLen;
            $token .= $key . $val . $res;
        }
        $token .= $this->apiSecret;
        return sha1($token);
    }

    public function addOrder($name, $email, $phone, $quantity) {
        $resp = $this->sendRequest("$this->host/addOrder",
            array("name" => $name, "email" => $email, "phone" => $phone, "quantity" => $quantity));

        return $resp;
    }
}
