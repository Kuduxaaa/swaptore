<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderProduct;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;
use PayzeIO\LaravelPayze\Requests\JustPay;

class CartController extends Controller
{
    public function show() 
    {
        $cart_items = auth()->user()->carts()->paginate(15);

        return view('home.cart', compact('cart_items'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|numeric',
            'quantity' => 'nullable|numeric'
        ]);

        $product_id = $request->input('product_id');
        $product = Product::where('id', $product_id)->first();
        $quantity = $request->input('quantity');

        if (!$product)
        {
            return redirect()->back()->with('error', 'This product is not available right now');
        }

        $already = Cart::where('product_id', $product->id)->where('user_id', auth()->user()->id)->first();

        if ($already)
        {
            $already->update([
                'quantity' => $already->quantity += ($quantity ?? 1)
            ]);
        }
        else
        {
            Cart::create([
                'product_id' => $product->id,
                'user_id' => auth()->user()->id,
                'quantity' => $quantity ?? 1
            ]);
        }

        return redirect()->back();
    }

    public function removeFromCart($product_id)
    {
        $cart = Cart::where('product_id', $product_id)->where('user_id', auth()->user()->id)->first();

        if ($cart)
        {
            $cart->delete();
        }

        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'cart_items' => 'required|array|min:1',
            'cart_items.*.product_id' => 'required|integer|exists:products,id',
            'cart_items.*.quantity' => 'required|integer|min:1',
        ]);

        $cart_items = $request->input('cart_items');
        $userId = auth()->user()->id;
        $amount = 0;

        $order = Orders::create([
            'order_id' => uniqid() . uniqid(),
            'transaction_id' => null,
            'user_id' => $userId,
        ]);

        foreach ($cart_items as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
            ]);

            $amount = $amount + ($item['price'] * $item['quantity']);
        }

        return JustPay::request($amount)
            ->for($order)
            ->currency('USD')
            ->language('en')
            ->preauthorize()
            ->process();
    }
}
