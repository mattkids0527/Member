<?php

namespace wayne;

class Auth
{
//base64編碼
private $data="eyJhbGdvIjoic2hhMjU2IiwidHlwZSI6IkpXVCJ9.eyJpc3N1ZXIiOiJHdWVzdCIsImV4cCI6Im5vbmUifQ.OTc5ZDhjMjRiNGFlNjczZjZkMzgwNGU3ZTU0MTJmMzFkNGM5YjRhZjAzNTVhZDJkZjIwZDAzODk3OGRlOWIxOQ";
private $header = array(
    "algo"=>"sha256",
    "type"=>"JWT"  
);
private $payload = array(
    "issuer"=>"Guest",
    "exp"=>"none",
);

private $token = "206671b446c8fa2208e96584ed96f03152ea0d3afbaad3d37ddb20275e2ffc79";

public $stateCode = array(
    
);

//初始方法
function __construct(){
    //$this->jwt_encrypt($this->header,$this->payload,$this->token);
    //$this->jwt_authentication($this->data,$this->token);
}

//base64URL編碼方法
public static function base64Urlencode($en_data){
 return rtrim(strtr(base64_encode($en_data),'+/','-_'),"=");
 //return base64_encode($en_data);
}

//base64URL解碼方法
public static function base64Urldecode($de_data){
 $mod = 4- (strlen($de_data) %4);
 $de_data = strtr($de_data,'-_','+/');
 return base64_decode($de_data .= str_repeat("=",$mod));
}
//Jwt加密
static function jwt_encrypt($header,$payload,$token){
    $header = json_encode($header);
    $payload = json_encode($payload);
    $signature = hash_hmac('sha256',self::base64Urlencode($header).".".self::base64Urlencode($payload),$token);

    echo self::base64Urlencode($header).".".self::base64Urlencode($payload).".".self::base64Urlencode($signature);
}
//Jwt驗證
static function jwt_authentication($jwt_data,$token){
    $arr = explode(".",$jwt_data);
    $authen = hash_hmac('sha256',$arr[0].".".$arr[1],$token);
    
    if(self::base64Urldecode($arr[2])!=$authen){
        echo "400 Bad Request!!";
    }else{
        echo "201 Good";
    }

}

}
?>