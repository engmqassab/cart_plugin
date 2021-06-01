<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Throwable;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $products = Cart::with('product')
            ->Where('id', $request->cookie('cart_id'))
            ->get();
            $type = false;
            foreach ($products as $item) {
                    if($item->product_id){
                        $type=true;
                    }
                };
        if (!$type) {
            return redirect()->route('cart');
        }
        else{
        $total = $products->sum(function($item) {
            return $item->product->final_price * $item->quantity;
        });
        $amount = Session::get('CouponAmount');
        $f_total = $total - $amount;
        DB::beginTransaction();
        try {
            $order = Order::create([
                'total' => $f_total,
            ]);

            foreach ($products as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->final_price,
                ]);
            }
            Cart::Where('id', $request->cookie('cart_id'))->delete();
            Coupon::where('code_coupon',Session::get('CouponCode'))->update([
                'status' => "NotActive"
            ]);
            
             Session::forget('CouponAmount');
             Session::forget('CouponCode');    
            
            DB::commit();



            return redirect()->route('orders.index')->with('success', 'Order created');

        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    }
}
