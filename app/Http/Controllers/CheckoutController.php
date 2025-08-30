<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Address;
use App\Models\Variant;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Routing\Controller as BaseController;

class CheckoutController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Cart::instance('shopping');

        $content = Cart::content()->filter(function ($item) {
            return $item->qty <= $item->options['stock'];
        });

        $subtotal = $content->sum(function ($item) {
            return $item->subtotal;
        });
        
        return view('checkout.index', compact('content', 'subtotal'));
    }

   public function paid(Request $request)
    {

        Cart::instance('shopping');

        $content = Cart::content()->filter(function ($item) {
            return $item->qty <= $item->options['stock'];
        });

        $address = Address::where('user_id', auth()->id())
                    ->where('default', true)
                    ->first();

        $order = Order::create([
            'user_id' => auth()->id(),
            'content' => $content, 
            'address' => $address ? $address->toArray() : null,
            'total' => Cart::subtotal(),
           
        ]);

        foreach ($content as $item) {
            Variant::where('sku', $item->options['sku'])->decrement('stock', $item->qty);

            Cart::remove($item->rowId);
        }

        return view('gracias', compact('order'));
    }
}