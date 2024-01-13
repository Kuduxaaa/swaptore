<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\LoginLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login() 
    {
        if (auth()->user())
        {
            $route = (auth()->user()->role == 2) ? 'admin' : 'index';

            return redirect()->route($route); 
        }

        return view('admin.login');
    }

    public function proccess(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $data = [
            'email' => $email,
            'password' => $password
        ];

        if (auth()->attempt($data)) 
        {
            $user = auth()->user();
            $route = (auth()->user()->role == 2) ? 'admin' : 'index';

            $this->log('success', 'User ID: ' . strval($user->id), $request);
            return redirect()->route($route);
        }
        else
        {
            $this->log('failed', null, $request);            
            
            return redirect()->back()->with('error', 'Email or password is incorrect');
        }
    }

    public function log($status, $comment, $request)
    {
        LoginLog::create([
            'status' => $status,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'comment' => $comment
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }

    public function register() 
    {
        if (auth()->user())
        {
            $route = (auth()->user()->role == 2) ? 'admin' : 'index';

            return redirect()->route($route); 
        }

        return view('admin.register');
    }

    public function perform_register (Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'primary_address' => 'required|string',
            'secondary_address' => 'nullable|string',
            'zip_code' => 'required|string',
            'password' => 'required|confirmed|min:8',
        ]);

        $userData = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'password' => bcrypt($request->input('password')),
            'role' => 1,
        ];

        $user = User::create($userData);
        $user->addresses()->create([
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'primary_address' => $request->input('primary_address'),
            'secondary_address' => $request->input('secondary_address'),
            'zip_code' => $request->input('zip_code'),
            'user_id' => $user->id
        ]);

        return redirect(route('login'))->with('message', 'User information saved successfully');
    }
}
