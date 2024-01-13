<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function show()
    {
        $orders = Orders::orderBy('id', 'desc')->paginate(20);

        return view('admin.pages.orders.show', compact('orders'));
    }
}
