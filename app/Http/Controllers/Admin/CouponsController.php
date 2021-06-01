<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $coupons = Coupon::paginate();

        return view('admin.coupons.index', [
            'coupons' => $coupons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.create',[
            'coupon' => new Coupon(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_coupon' => 'required|max:255|unique:coupons,code_coupon,$id',
            'amount' => 'required|numeric|min:0',
            'expiry_date' => 'required',
        ]);

        $coupon = Coupon::create($request->all());
       
        return redirect()
            ->route('admin.coupons.index')
            ->with('success', "Coupon ({$coupon->id}) created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupons.edit', [
            'coupon' => $coupon,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'code_coupon' => 'required|max:255',
            'amount' => 'required|numeric|min:0',
            'expiry_date' => 'required',
            'status' => 'required',
        ]);


        $coupon->update($request->all());

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', "Coupon ({$coupon->id}) updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', "Coupon ({$coupon->id}) deleted!");
    }
}
