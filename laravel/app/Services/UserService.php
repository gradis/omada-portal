<?php

namespace App\Services;

use App\Models\MacAddresses;
use App\Models\User;

class UserService
{
    public function CheckUserIfHaveAccess($userData):bool {
        if ($userData['field'] != 'number')
            $user = User::where('username', $userData['username'])->first();
        else
            $user = User::where('number', $userData['number'])->first();

        return $user->haveAccess;
    }

    public function MacAdressProcess($userData) {
        if ($userData['field'] != 'number'){
            $user = User::where('username', $userData['login'])->first();
            if (!is_null($user))
                $number = $user->number;
        }
        else
            $number = $userData['login'];

        $macaddress = MacAddresses::create([
                'number' => $number,
                'mac_address' => $userData['clientMac']
            ]
        );
    }

    public function editMacAddress()
    {

    }
}
