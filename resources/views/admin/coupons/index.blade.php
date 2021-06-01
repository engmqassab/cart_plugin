@extends('layouts.admin')

@section('title', 'Coupons')



@section('content')
<div class="container">

<div class="d-flex justify-content-between">
    <h1 class="mb-5">Coupons</h1>
    <div>
        <a href="/admin/coupons/create" class="btn btn-outline-primary btn-sm mb-3">Create New</a>
    </div>
</div>

<x-alerts/>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Coupon Code</th>
            <th>Amount</th>
            <th>Amount Type</th>
            <th>Expiry Date</th>
            <th>Status</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
            @foreach($coupons as $coupon)
            <tr>
            <td class="center">{{ $coupon->id }}</td>
                  <td class="center">{{ $coupon->code_coupon }}</td>
                  <td class="center">{{ $coupon->amount }}</td>
                  <td class="center">{{ $coupon->amount_type }}</td>
                  <td class="center">{{ $coupon->expiry_date }}</td>
                  <td class="@if ($coupon->status == 'Active') bg-primary @else
                            bg-danger @endif">{{ $coupon->status }}</td>
                <td>
                    <a class="btn btn-sm btn-dark" href="{{ route('admin.coupons.edit', [$coupon->id]) }}">Edit</a>
                </td>
                <td>
                    <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" class="form-inline"  
                    onclick="return confirm('Are you sure !!');" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection