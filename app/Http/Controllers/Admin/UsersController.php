<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show_members()
    {
        $members = User::where('role', 1)->orderBy('created_at', 'desc')->paginate(50);

        return view('admin.pages.users.members', ['members' => $members]);
    }

    public function show_admins()
    {
        $members = User::where('role', 2)->orderBy('created_at', 'desc')->paginate(50);

        return view('admin.pages.users.members', ['members' => $members]);
    }

    public function edit($id = null)
    {
        $user = ($id !== null) ? User::where('id', $id)->first() : null;

        return view('admin.pages.users.edit', ['user' => $user]);
    }

    public function edit_perform(Request $request, $id = null)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'role' => 'required|numeric',
            'country' => 'required|string',
            'city' => 'required|string',
            'primary_address' => 'required|string',
            'secondary_address' => 'nullable|string',
            'zip_code' => 'required|string',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $userData = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'role' => (int) $request->input('role'),
        ];

        $password = $request->input('password');

        if ($id) 
        {
            $user = User::where('id', $id)->first();

            if (!$user)
            {
                return abort(400);
            }

            $user->update($userData);
        } 
        else 
        {
            if ($password == null) 
            {
                return redirect()->back()->withErrors(['password' => 'Password is required for new users']);
            }

            $userData['password'] = bcrypt($request->input('password'));
            $user = User::create($userData);
        }

        $addressData = [
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'primary_address' => $request->input('primary_address'),
            'secondary_address' => $request->input('secondary_address'),
            'zip_code' => $request->input('zip_code'),
            'user_id' => $user->id
        ];

        if ($user->addresses) 
        {
            $user->addresses->update($addressData);
        } 
        else 
        {
            $user->addresses()->create($addressData);
        }

        if ($password !== null) 
        {
            $user->update(['password' => bcrypt($request->input('password'))]);
        }

        return redirect()->back()->with('message', 'User information saved successfully');
    }

    public function destroy($id)
    {
        if (auth()->user()->id == $id)
        {
            return redirect()->back()->with('message', 'You can\'t remove yourself <3');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('message', 'User removed successfully');
    }
}
