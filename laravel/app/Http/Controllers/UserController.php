<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function submit(UserRequest $request)
    {
        return "okey";
    }

    public function createUser(CreateUserRequest $request) {
        $user = User::create([
            'firstName'=> $request->input('firstName'),
            'middleName'=> $request->input('middleName'),
            'secondName'=> $request->input('secondName'),
            'number'=> $request->input('number'),
            'grade'=> $request->input('grade'),
            'password'=> Hash::make($request->input('password')),
            'group'=> $request->input('user_group'),
            'haveAccess'=> $request->input('haveAccess')
        ]);

        return redirect()->route('user.add')->with('success', "Пользователь добавлен!");
    }

    //Working with data

    public function allData() {
        return view('dashboard', ['data' => User::all()]);
    }

    public function search(Request $request) {
        $query = $request->input('query');

        $filtredUsers = User::where('secondName', 'like', "%$query%")->
                        orWhere('middleName', 'like', "%$query%")->
                        orWhere('secondName', 'like', "%$query%")->
                        orWhere('number', 'like', "%$query%")->
                        orWhere('grade', 'like', "%$query%")->get();
        return view('dashboard', ['data' => $filtredUsers, 'query' => $query]);
    }

    public function editUser($id) {
        $user = User::FindOrFail($id);

        return view('editUser', compact('user'));
    }

    public function updateUser(Request $request, $id) {
        $user = User::find($id);

        $user->update([
            'firstName'=> $request->input('firstName'),
            'middleName'=> $request->input('middleName'),
            'secondName'=> $request->input('secondName'),
            'number'=> $request->input('number'),
            'group'=> $request->input('user_group'),
            'username' => $request->input('username'),
            'grade' => $request->input('grade'),
            'hasAccess' => $request->input('haveAccess'),
        ]);

        if ($request->filled('password'))
            $user->password = Hash::make($request->input('password'));

        $user->save();

        return redirect()->route('user.edit', $id);
    }

    public function updateMultiple(Request $request, $id) {

    }

    public function deleteUser($id) {
        $user = User::find($id);

        $user->delete();
        return redirect()->route('dashboard')->with('success', 'Пользователь удален');
    }
}
