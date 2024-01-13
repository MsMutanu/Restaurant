@extends('layouts.waiter')
@section('title', 'Manage Tables')

@section('content')
<div class="container">
    <h1>Restaurant Tables</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Table Name</th>
                <th>Availability</th>
                <th>Capacity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($restauranttables as $table)
            <tr>
                <td>{{ $table->name }}</td>
                <td>
                   {{ $table->status}}
                </td>
                <td>{{ $table->capacity }}</td>
        <td>
            <form action="{{ route('waiter.TableAvailable', $table->id) }}" method="post">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-info btn-sm">Mark As Available</button>
            </form>
            <form action="{{ route('waiter.TableUnavailable', $table->id) }}" method="post">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-info btn-sm">Mark As Unavailable</button>
            </form>

        </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
