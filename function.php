<?php


    function getRsa2Sign($arr){
       return rsaSign(getStr($arr,'RSA2'), APPPRIKEY,'RSA2') ;
    }

    function setRsa2Sign($arr){
        $arr['sign'] =getRsa2Sign($arr);
        return $arr;
    }

    function getStr($arr,$type = 'RSA'){
        //筛选  
        if(isset($arr['sign'])){
            unset($arr['sign']);
        }
        if(isset($arr['sign_type']) && $type == 'RSA'){
            unset($arr['sign_type']);
        }
        //排序  
        ksort($arr);
        //拼接
       return getUrl($arr,false);
    }

    function getUrl($arr,$encode = true){
       if($encode){
            return http_build_query($arr);
       }else{
            return urldecode(http_build_query($arr));
       }
    }
    function rsaSign($data, $private_key,$type = 'RSA') {

            $search = [
                    "-----BEGIN RSA PRIVATE KEY-----",
                    "-----END RSA PRIVATE KEY-----",
                    "\n",
                    "\r",
                    "\r\n"
            ];

            $private_key=str_replace($search,"",$private_key);
            $private_key=$search[0] . PHP_EOL . wordwrap($private_key, 64, "\n", true) . PHP_EOL . $search[1];
            $res=openssl_get_privatekey($private_key);

            if($res)
            {
                if($type == 'RSA'){
                    openssl_sign($data, $sign,$res);
                }elseif($type == 'RSA2'){
                    //OPENSSL_ALGO_SHA256
                    openssl_sign($data, $sign,$res,OPENSSL_ALGO_SHA256);
                }
                    openssl_free_key($res);
            }else {
                    exit("私钥格式有误");
            }
            $sign = base64_encode($sign);
            return $sign;
    }
    function rsaCheck($data, $public_key, $sign,$type = 'RSA')  {
            $search = [
                    "-----BEGIN PUBLIC KEY-----",
                    "-----END PUBLIC KEY-----",
                    "\n",
                    "\r",
                    "\r\n"
            ];
            $public_key=str_replace($search,"",$public_key);
            $public_key=$search[0] . PHP_EOL . wordwrap($public_key, 64, "\n", true) . PHP_EOL . $search[1];
            $res=openssl_get_publickey($public_key);
            if($res)
            {
                if($type == 'RSA'){
                    $result = (bool)openssl_verify($data, base64_decode($sign), $res);
                }elseif($type == 'RSA2'){
                    $result = (bool)openssl_verify($data, base64_decode($sign), $res,OPENSSL_ALGO_SHA256);
                }
                    openssl_free_key($res);
            }else{
                    exit("公钥格式有误!");
            }
            return $result;
    }

    ?>