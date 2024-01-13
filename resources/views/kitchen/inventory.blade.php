@extends('layouts.kitchen')
@section('title', 'Inventory')

@section('content')
<div class="container">
    <h1>Menu Inventory</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Availability</th>
                <th>In Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menuItems as $item)
            <tr>
                <td>{{ $item->item_name }}</td>
                <td>
                    @if ($item->availability)
                        <span class="text-success">Available</span>
                    @else
                        <span class="text-danger">Not Available</span>
                    @endif
                </td>
                <td>{{ $item->in_stock }}</td>
        <td>
            <a href="{{ route('kitchen.edit', $item->id) }}" class="btn btn-primary">Edit</a>

        </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
