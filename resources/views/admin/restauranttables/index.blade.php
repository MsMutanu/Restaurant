@extends('layouts.app')
@section('title', 'Tables || admin controller')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <h4 class="fs-4 p-3">Restaurant Tables</h4>

            <div class="col-md-12 mt-3">
                <div class="card shadow-none">
                    <div class="card-header card-header-primary">
                        <a href="{{ route('restauranttables.create') }}" class="btn btn-primary">Add table</a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered">
                                <thead class=" text-primary">

                                    <th> name</th>
                                    <th> Capacity</th>
                                    <th> Availability</th>
                                    <th> Action </th>

                                </thead>
                                <tbody>

                                    @foreach($restauranttables as $restauranttable)
                                    <tr>

                                        <td>{{$restauranttable->name}}</td>
                                        <td>{{$restauranttable->capacity}}</td>
                                        <td>{{$restauranttable->status}}</td>
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.restauranttables.edit', $restauranttable->id) }}"
                                                    class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.restauranttables.destroy', $restauranttable->id) }}"
                                                    method="POST" onsubmit="return confirm('Are you sure?');"
                                                    class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">Delete</button>
                                                </form>
                                            </div>

                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endpush
