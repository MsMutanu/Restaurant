@extends('layouts.app')
@section('title', 'Users || Admin Controller')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <h4 class="fs-4 p-3">User Table</h4>

            <div class="col-md-12 mt-3">
                <div class="card shadow-none">
                    <div class="card-header card-header-primary">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" >
                                <thead class=" text-primary">
                                    <th> ID </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Phone </th>
                                    <th> Is Admin </th>
                                    <th> Action </th>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td> {{ $user->id }} </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                                        <td class="td-actions text-left">
                                            <a href="{{ route('admin.users.edit', $user->id)}}" style="float:left">
                                                <button type="button" rel="tooltip" title="Edit User" class="btn btn-link btn-sm">
                                                    <i class="fa-solid fa-pen-to-square text-blue"></i>
                                                </button>
                                            </a>

                                            <form id="delete-form-{{$user->id}}" action="{{ route('admin.users.destroy', $user->id)}}" 
                                                method="post" style="display:none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="submit" rel="tooltip" title="Remove User" class="btn btn-link btn-sm" onclick="if(
                                                confirm('Are you sure to delete this user?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{$user->id}}').submit();
                                                }else{
                                                    event.preventDefault();
                                                }">
                                                <i class="fa-solid fa-trash-can text-danger"></i>
                                            </button>

                                            <a href="{{ route('admin.users.show', $user->id)}}" style="display:none" style="margin-left:20px">
                                                <button type="button" rel="tooltip" title="View User" class="btn btn-primary btn-link btn-sm">
                                                    <i class="material-icons"></i>View
                                                </button>
                                            </a>
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
