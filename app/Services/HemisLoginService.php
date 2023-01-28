<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class HemisLoginService
{
    public static function login($login,$password)
    {
        $client = new Client(['verify' => false]);
        $options = [
            'multipart' => [
                [
                    'name' => 'login',
                    'contents' => "{$login}"
                ],
                [
                    'name' => 'password',
                    'contents' => "{$password}"
                ]
            ]];
        $request = new Request('POST', 'https://student.ubtuit.uz/rest/v1/auth/login');
        $res = $client->sendAsync($request, $options)->wait();
        $a=json_decode($res->getBody());
        if ($a->success){
            session()->put('hemistoken',$a->data->token);
            session()->put('loggedin',true);
        }
        return $a->success;

    }



}