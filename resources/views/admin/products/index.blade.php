@extends('layouts.admin')

@section('title', 'Products')

@section('nav')
@parent
<a href="#" class="nav-link">Users</a>
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h1 class="mb-5">Products</h1>
    <div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary btn-sm mb-3">Create New</a>
    </div>
</div>

<x-alerts/>



<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Created At</th>
            <th>Update At</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
            @forelse($products as $product)
            <tr>
                <td><img src="{{ $product->image_url }}" height="60" alt=""></td>
                <td>{{ $product->id }}</td>
                <td class="text-success">{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->updated_at }}</td>
                <td>
                    <a class="btn btn-sm btn-dark" href="{{ route('admin.products.edit', [$product->id]) }}">Edit</a>
                </td>
                <td>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" class="form-inline" 
                    onclick="return confirm('Are you sure !!');" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">No Products</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection