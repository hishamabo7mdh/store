@extends('layouts.dashboard')
@section('title', 'Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">categories</li>
@endsection


@section('content')

<div class="mb-5">
    <a href="{{ route('categories.create')}}" class="btn btn-sm btn-outline-success">Create</a>
</div>

@if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session()->has('info'))
    <div class="alert alert-success">
        {{ session('info') }}
    </div>
@endif


<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Created at</th>
            <th>image</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
            <tr>
                <td></td>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->parent_id }}</td>
                <td>{{ $category->created_at }}</td>
                <td>
                    <img src="{{ asset('storage/' . $category->image) }}" alt="image" height="50px">
                    </td>
                <td>
                    <a href="{{ route('categories.edit',$category->id) }}" class="btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form action="{{ route('categories.destroy',$category->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No categories define.</td>
            </tr>    
        @endforelse
    </tbody>
</table>

@endsection
