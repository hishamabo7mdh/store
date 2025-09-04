@extends('layouts.dashboard')
@section('title', 'create')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">create</li>
@endsection


@section('content')
    <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            @include('dashboard.categories._form',[
            'button_label' => 'update',
            'category' => $category
        ])
    </form>

@endsection
