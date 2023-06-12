
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product Categories</h1>

        <div class="mb-3">
            <a href="{{ route('productycategory.create') }}" class="btn btn-primary">Add New Category</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->category_id }}</td>
                        <td>{{ $category->category }}</td>
                        <td>
                            <a href="{{ route('productcategory.edit', $category->category_id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('productcategory.destroy', $category->category_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
