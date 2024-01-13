@extends('layouts.kitchen')
@section('title', 'Edit Item')

@section('content')
<div class="container">
    <h1>Edit Menu Item</h1>
    <form  method="post" action="{{ route('kitchen.updateMenuItemAvailability', ['item' => $item->id]) }}">
        @csrf


        <div class="form-group">
            <label for="in_stock">In Stock</label>
            <input type="number" name="in_stock" id="in_stock" value="{{ $item->in_stock }}">
        </div>

        <div class="form-group">
            <label for="availability">Availability</label>
            <select name="availability" id="availability">
                <option value="1" @if ($item->availability == 1) selected @endif>Available</option>
                <option value="0" @if ($item->availability == 0) selected @endif>Not Available</option>
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
