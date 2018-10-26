@extends('layouts.global')

@section('title') Create Category @endsection

@section('content')

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}    
        </div>
    @endif

    <form enctype="multipart/form-data"
        class="bg-white shadow-sm p-3" 
        action="{{route('categories.store')}}"
        method="post">
        @csrf

        <label>Category Name</label><br>
        <input  type="text" 
                name="name" 
                class="form-control">
        <br>

        <label>Category Image</label><br>
        <input  type="file" 
                name="image" 
                class="form-control">
        <br>

        <input type="submit" value="Save" class="btn btn-primary"> 

    </form>
@endsection