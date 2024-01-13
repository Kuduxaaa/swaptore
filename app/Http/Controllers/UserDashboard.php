<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDashboard extends Controller
{
    public function show()
    {
        $user = User::findOrFail(auth()->user()->id);

        $orders = DB::table('orders')
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->where('orders.user_id', $user->id)
            ->select('orders.*', 'order_products.*', 'products.title', 'products.images')
            ->paginate(10); 
            
        return view('home.profile', compact('user', 'orders'));
    }

    public function update_user_info(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'current_password' => 'nullable|string|min:8',
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        $user = auth()->user();
        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'phone_number' => $request->input('phone_number'),
        ]);

        if ($request->filled('current_password') && $request->filled('password')) 
        {
            if (Hash::check($request->input('current_password'), $user->password)) 
            {
                $user->update([
                    'password' => bcrypt($request->input('password'))
                ]);

                Auth::logout();
            } 
            else 
            {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }
        }

        return redirect()->back()->with('success', 'User information updated successfully.');
    }

}
