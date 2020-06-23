<?php


class Weenect
{

    static $api_url = 'https://apiv4.weenect.com/v4';
    static $token = null;

    public static function send($url, $post){

        $ch = curl_init( self::$api_url.$url );

        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post);

        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
            'Origin: https://my.weenect.com'
            ,'Content-Type: application/json'
            ,'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36'
            ,'Accept: application/json'
            ,'x-app-version: 0.1.0'
            ,'x-app-user-id: '
            ,'x-app-type: userspace'
            ,'DNT: 1'
        ));

        $d = curl_exec( $ch );

        /*
        // check the HTTP status code of the request
        $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $info = curl_getinfo($ch);

        echo '<pre>';
        var_dump($info);
        echo '<pre/>';

        echo 'HTTP '.$resultStatus.'<br/>';

        var_dump($d);
        */

        return $d;

    }

    public static function login($user, $pass){
        $data = self::send('/user/login', json_encode([
            'username' => $user,
            'password' => $pass]));


        $data = json_decode($data);

        self::$token = $data->access_token;
    }

    public static function getTracker(){


        $ch = curl_init( self::$api_url.'/mytracker' );

        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
            'Origin: https://my.weenect.com'
            ,'Content-Type: application/json'
            ,'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36'
            ,'Accept: application/json'
            ,'x-app-version: 0.1.0'
            ,'x-app-user-id: '
            ,'x-app-type: userspace'
            ,'DNT: 1'
            ,'Authorization: JWT '.self::$token
        ));
        $d = curl_exec( $ch );

        /*
        // check the HTTP status code of the request
        $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $info = curl_getinfo($ch);

        echo '<pre>';
        var_dump($info);
        echo '<pre/>';

        echo 'HTTP '.$resultStatus.'<br/>';

        var_dump($d);
        */

        return $d;
    }

}