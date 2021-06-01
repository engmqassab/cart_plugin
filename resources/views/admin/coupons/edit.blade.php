@extends('layouts.admin')

@section('title', 'Edit Coupons')

@section('content')

    <h1>Update Coupon</h1>

    <form action="/admin/coupons/{{ $coupon->id }}" method="post">
        @csrf
        @method('PUT')

        @include('admin.coupons._form')
    </form>
@endsection