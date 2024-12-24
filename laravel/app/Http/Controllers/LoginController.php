<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\OmadaApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;

class LoginController extends Controller
{

    protected  $userService;
    public function __construct()
    {
        $this->userService = new UserService();
        $this->OmadaApiService = new OmadaApiService();
    }

    public function showLoginForm(Request $request) {
        $queryParams = $request->query();
        return view('home', ['queryParams' => $queryParams]);
    }
    public function adminAuth(UserRequest $request) {
        $login = $request->input(['login']);
        $field = is_numeric($login) ? 'number' : 'username';
        $credentials = [$field => $request->input('login'), 'password' => $request->input('password')];
        if (Auth::attempt($credentials))
            return redirect()->route('dashboard');
        return back()->withErrors([
            'message' => 'Введены неверные данные!',
        ]);
    }

    public function loginToInternet(UserRequest $request) {
        $login = $request->input(['login']);
        $field = is_numeric($login) ? 'number' : 'username';
        $userData = array(
            'field' => $field,
            'login' => $login,
            'clientMac' => $request->input('clientMac'),
            'clientIp' => $request->input('clientIp'),
            't' => $request->input('t'),
            'site' => $request->input('site'),
            'redirectUrl' => $request->input('redirectUrl'),
            'apMac' => $request->input('apMac'),
            'ssidName' => $request->input('ssidName'),
            'radioId' => $request->input('radioId'),
            'gws_rd' => $request->input('gws_rd'),
        );

        $user = User::where($field, $login)->first();

        $credentials = [$field => $request->input('login'), 'password' => $request->input('password')];
        if (Auth::attempt($credentials))
        {
            if ($user->haveAccess)
                $response = $this->OmadaApiService->loginInApi($userData);
            else
                return back()->with('success', 'Ошибка :(');

            if($response)
            {
                $this->userService->MacAdressProcess($userData);
                return redirect()->route('success');
            }
        }
        return back()->withErrors([
            'message' => 'Введены неверные данные!'
        ]);
    }

    public function showSuccess(Request $request) {
        return view('success');
    }
}
