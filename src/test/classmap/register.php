<?php
namespace wayne\register;

interface register{
    function createToken();
    function getToken();
}

class regis implements register
{
    private $user = "Guest";
    
    function __construct(){
        //
    }

    function createToken(){
        $data = $this->user.time();
        return hash_hmac('sha256',$data,$this->user);
    }

    function getToken(){

    }

}

//$register = new regis();
//206671b446c8fa2208e96584ed96f03152ea0d3afbaad3d37ddb20275e2ffc79

?>