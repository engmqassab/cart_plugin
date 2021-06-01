@extends('layouts.admin')

@section('title', 'Create Coupons')

@section('content')

<h1>Create Coupons</h1>

<form action="/admin/coupons" method="post">
    @csrf
    @include('admin.coupons._form')
</form>

@endsection
