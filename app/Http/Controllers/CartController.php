<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {

        $cart = Cart::with('product')->where('id', $this->getCartId())
            ->get();

        $sub_total = $cart->sum(function($item) {
            return $item->quantity * $item->product->final_price;
        });

        $tax_ratio = 14;
        $tax = $sub_total * $tax_ratio / 100;
        $total = $sub_total + $tax;

        return view('cart', [
            'items' => $cart,
            'sub_total' => $sub_total,
            'tax' => $tax,
            'total' => $total,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['int', 'min:1'],
        ]);

        $cart = Cart::updateOrCreate([
            'id' => $this->getCartId(),
            'product_id' => $request->post('product_id'),
        ], [
            'quantity' => DB::raw('quantity + ' . $request->post('quantity', 1)),
        ]);

        $name = $cart->product->name;

        if ($request->expectsJson()) {
            return Cart::with('product')->where('id', $this->getCartId())
            ->get();
        }

        return redirect()->back()->with('status', "Product $name added to cart");

        //$product = Product::findOrFail($request->post('product_id'));
        //return redirect()->back()->with('status', "Product $product->name added to cart");
    }

    public function update(Request $request)
    {
        $request->validate([
            'quantity' => ['required', 'array'],
        ]);

        $that = $this;
        foreach ($request->post('quantity') as $product_id => $quantity) {
            Cart::where('product_id', $product_id)
                ->where(function($query) use ($that) {
                    $query->where('id', '=', $that->getCartId())
                        ;
                })->update([
                    'quantity' => $quantity,
                ]);
        }

        return redirect()->back()->with('status', "Cart updated");
    }

    public function destroy()
    {
        Cart::where('id', '=', $this->getCartId())->delete();
        $cookie = Cookie::make('cart_id', '', -60);
        return redirect()->back()->with('status', "Cart cleared")->cookie($cookie);
    }

    public function deleteItem($id)
    {
        $that = $this;
        
        $item = Cart::where('product_id', $id)
                ->where(function($query) use ($that) {
                    $query->where('id', '=', $that->getCartId())
                        ;
                });
        $item->delete();
        return redirect()
        ->back();

    }
    public function applyCoupon(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/
        $couponCount = Coupon::where('code_coupon',$data['code_coupon'])->count();
        if($couponCount == 0){
            return redirect()->back()->with('error','This coupon is not active!');
        }else{

            $couponDetails = Coupon::where('code_coupon',$data['code_coupon'])->first();
            if($couponDetails->status == 'NotActive'){
                return redirect()->back()->with('error','This coupon is not active!');
            }
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');
            if($expiry_date < $current_date){
                return redirect()->back()->with('error','This coupon is expired!');
            }

            $session_id = Session::get('session_id');
            $userCart =  Cart::with('product')->where('id', $this->getCartId())
            ->get();
            $total_amount = 0;
            
            foreach($userCart as $item){
               $total_amount = $total_amount + ($item->product->final_price * $item->quantity);
            }
            // Check if amount type is Fixed or Percentage
            if($couponDetails->amount_type=="Fixed"){
                $couponAmount = $couponDetails->amount;
            }else{
                $couponAmount = $total_amount * ($couponDetails->amount/100);
            }

            // Add Coupon Code & Amount in Session
            Session::put('CouponAmount',$couponAmount);
            Session::put('CouponCode',$data['code_coupon']);

            return redirect()->back()->with('success','Coupon code successfully
                applied. You are availing discount!');

        }
    }

    protected function getCartId()
    {
        $id = request()->cookie('cart_id');
        if (!$id) {
            $id = Str::uuid();
            Cookie::queue('cart_id', $id, 60 * 24 * 7);
        }
        return $id;
    }

    
}
