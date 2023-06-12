@extends('layouts.app')

@section('content')
    <h1>Product Names</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="product-names">
        <a href="{{ route('productnames.create') }}" class="btn btn-primary">Add New Product Name</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($productNames as $productName)
                    <tr>
                        <td>{{ $productName['name_id'] }}</td>
                        <td>{{ $productName['product_name'] }}</td>
                        <td>
                            <a href="{{ route('productnames.edit', $productName['name_id']) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('productnames.destroy', $productName['name_id']) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
