@extends('layouts.admin')

@section('title', 'Categories')



@section('content')
<div class="container">

<div class="d-flex justify-content-between">
    <h1 class="mb-5">Categories</h1>
    <div>
        <a href="{{route('admin.categories.create')}}" class="btn btn-outline-primary btn-sm mb-3">Create New</a>
    </div>
</div>

<x-alerts/>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Products #</th>
            <th>Created At</th>
            <th>Update At</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->id }}</td>
                <td class="text-success">{{ $category->name }}</td>
                <td>{{ $category->parent->name }}</td>
                <td>{{ $category->products_count }}</td>
                <td>{{ $category->created_at->format('l, F d, Y h:i:s A') }}</td>
                <td>{{ $category->updated_at->diffForHumans() }}</td>
                <td>
                    <a class="btn btn-sm btn-dark" href="{{ route('admin.categories.edit', [$category->id]) }}">Edit</a>
                </td>
                <td>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" class="form-inline"  
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