<?php

Class MyApi {
    var $appId = '';
    var $appSecret = '';
    var $url = "http://ivan.urandeals.eu/api/";

    function __construct($appId, $appSecret){
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    function request($method, $data, $request_type = "POST"){
        $data['request_time'] = time();
        $data['app_id'] = $this->appId;
        $data['access_token'] = $this->hash($data);

        $postdata = http_build_query(
            array(
                'request' => json_encode($data),
            )
        );

        $opts = array(
            'http' => array(
                'timeout' => 5,
                'method'  => $request_type,
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        $url = $this->url . $method;
        $context = stream_context_create($opts);
        $responseJSON = @file_get_contents($url, false, $context);
        $response = json_decode($responseJSON, true);

        if(empty($response)){
            echo "<pre>RESPONSE:\n{$responseJSON}</pre>";
            throw new Exception("File or directory not found.", 404);
        }

        return $response;

    }

    function hash($data){
        $str = $this->appId . "|";
        foreach($data as $k=>$v){
            if(!empty($k) && !empty($v) && !is_array($v)){
                $str .= "{$k}:{$v}|";
            }
        }
        $str .= $this->appSecret;
        return sha1($str);
    }

    function login(
        $username,$password
    ){
        return $this->request("login", array(
            "username" => $username,
            "password" => $password
        ));
    }
}


?>