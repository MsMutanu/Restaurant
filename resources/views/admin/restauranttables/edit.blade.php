@extends('layouts.app')

@section('title', 'Edit Table || admin controller')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="m-2 p-2 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.restauranttables.update', $restauranttable->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                            <div class="mt-1">
                                <input type="text" id="name" name="name" value="{{ $restauranttable->name }}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="capacity" class="block text-sm font-medium text-gray-700"> Capacity
                            </label>
                            <div class="mt-1">
                                <input type="number" id="capacity" name="capacity" value="{{ $restauranttable->capacity }}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('capacity')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <div class="mt-1">
                                <select id="status" name="status" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    <option value="available" {{ $restauranttable->status === 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="occupied" {{ $restauranttable->status === 'occupied' ? 'selected' : '' }}>Occupied</option>
                                    <option value="reserved" {{ $restauranttable->status === 'reserved' ? 'selected' : '' }}>Reserved</option>
                                </select>
                            </div>
                            @error('status')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                       
                        <div class="mt-6 p-4">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
