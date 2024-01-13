<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use PayzeIO\LaravelPayze\Models\PayzeTransaction;

class PayzeController extends \PayzeIO\LaravelPayze\Controllers\PayzeController
{
    /**
     * Success Response
     *
     * Do any transaction related operations and return a response
     * If nothing is returned, default response will be used
     *
     * @param \PayzeIO\LaravelPayze\Models\PayzeTransaction $transaction
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    protected function successResponse(PayzeTransaction $transaction, Request $request)
    {
        /*
         * Do any transaction related operations and return a response
         * If nothing is returned, default response will be used
         */
        
        $order = $transaction->model()->where('id', $transaction->model_id)->first();
        $order->update(['transaction_id' => $transaction->transaction_id]);

        $user = User::where('id', $order->user_id)->first();

        if ($transaction->is_paid)
        {
            $text = $this->generateNotification($user, $order);
            $this->sendInTelegram($text);

            $productIds = $order->orderProducts->pluck('product_id')->toArray();
            Cart::where('user_id', $user->id)->whereIn('product_id', $productIds)->delete();

            return redirect(route('cart'))->with('message', 'Payment was made successfully! More information can be found in Account > Orders');
        }

    }

    /**
     * Fail Response
     *
     * Do any transaction related operations and return a response
     * If nothing is returned, default response will be used
     *
     * @param \PayzeIO\LaravelPayze\Models\PayzeTransaction $transaction
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    protected function failResponse(PayzeTransaction $transaction, Request $request)
    {
        /*
         * Do any transaction related operations and return a response
         * If nothing is returned, default response will be used
         */

        return redirect(route('cart'))->with('error', 'Unable to purchase! Try again...');
    }

    private function sendInTelegram($text)
    {
        $text = urlencode($text);
        $url = 'https://api.telegram.org/bot' . env('TELEGRAM_TOKEN') . '/sendMessage?chat_id=' . env('TELEGRAM_CHAT_ID') . '&text=' . $text;

        file_get_contents($url);
    }

    private function generateNotification(User $user, Orders $order)
    {
        $tgMessage = sprintf("🪪 აიდი: %d\n👤 სახელი: %s\n👤 გვარი: %s\n☎️ ტ. ნომერი: %s\n\n🗺️ ქვეყანა: %s\n🗺️ ქალაქი: %s\n🗺️ მისამართი: %s\n\n",
            $user->id,
            $user->first_name,
            $user->last_name,
            $user->phone_number,
            $user->addresses->country,
            $user->addresses->city,
            $user->addresses->primary_address,  
        );
        
        foreach ($order->orderProducts as $product)
        {

            $tgMessage .= sprintf("🛒 პროდუქტი: %s\n🛒 რაოდენობა: %d\n🛒 ერთის ფასი: %d\n🛒 ჯამური ფასი: %d\n\n",
                $product->product->title,
                $product->quantity,
                ($product->product->discounted_price !== null) ? $product->product->discounted_price : $product->product->price,
                (($product->product->discounted_price !== null) ? floatval($product->product->discounted_price) : floatval($product->product->price)) * intval($product->quantity),
            );
        }

        $tgMessage .= '✅ დადასტურებულია ✅';
        return $tgMessage;
    }
}
