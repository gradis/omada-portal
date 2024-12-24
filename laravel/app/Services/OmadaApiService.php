<?php

namespace App\Services;

class OmadaApiService
{
    public function loginInApi($userData):bool {
        $seconds = 3600000;
        $t = $userData['t'];
        $site = $userData['site'];

        $loginInfo = array(
            "login" => env('CONTROLLER_NAME'),
            "password" => env('CONTROLLER_PASSWORD'),
        );

        $ip = env('CONTROLLER_IP');
        $port = env('CONTROLLER_PORT');
        $cid = env('CONTROLLER_ID');


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://'.$ip.':'.$port.'/'.$cid.'/api/v2/hotspot/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_COOKIEFILE => '',
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($loginInfo),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        if ($response !== false) {
            $json = json_decode($response, true);
            $csrfToken = $json['result']['token'];
        }
        else {
            die("Error: check with your network administrator");
        }

        $clientInfo = [
            "clientMac" => $userData['clientMac'],
            "apMac" => $userData['apMac'],
            'ssidName' => $userData['ssidName'],
            'radioId' => $userData['radioId'],
            'authType' => 4,
            'time' => $seconds
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://'.$ip.':'.$port.'/'.$cid.'/api/v2/hotspot/extPortal/auth',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($clientInfo),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Csrf-Token: ' . $csrfToken,
            ),
        ));

        $res = curl_exec($curl);
        curl_close($curl);

        if ($res !== false) {
            $json = json_decode($res, true);
            $code = $json['errorCode'];
            if ($code == "0") {
                echo "Авторизованы!";
                return true;
            } else {
                die("Error: check with your network administrator");
            }
        }
        else {
            die("Error: check with your network administrator");
        }
    }
}
