<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::orderBy('id', 'asc')->get();
        return response()->json($users);
    }

    public function getUser($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => ['required'],
            'email'     => ['required'],
            'cedula'                => ['required'],
            'photo'                 => ['required', 'image'],
            'address'               => ['required'],
            'phone'                 => ['required'],
        ]);

        $user = User::findOrFail($id);
        if($request->file()) {
            $name = strtolower(str_replace(
                ' ',
                '',
                $request->file('photo')->getClientOriginalName()
            ));

            $name = preg_replace('/[^A-Za-z0-9 _ .-]/', '', $name);

            $request->file('photo')->move(
                base_path() . '/public/users_profile/' . '/',
                $name
            );
            $routePath = '/users_profile/' . $name;
        }
        $user->name          = $request->name;
        $user->email         = $request->email;
        $user->cedula        = $request->cedula;
        $user->photo         = $routePath;
        $user->address       = $request->address;
        $user->phone         = $request->phone;

        $user->save();

        return response()->json($user);
    }

    public function changePassword(Request $request, $id)
    {

        $request->validate([
            'password'              => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();
    }

    public function switchActiveUser($id)
    {
        $user = User::find($id);
        $user->is_active = !$user->is_active;
        $user->save();
        return response()->json("Record deleted!");
    }
}
