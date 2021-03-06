@extends('layouts.global')

@section('title') User list @endsection

@section('content')
    <h2 style="padding-bottom: 10px;">Daftar User</h2>
    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

            <form action="{{route('users.index')}}">
                <div class="row">
                    <div class="col-md-6">
                        <input
                            value="{{Request::get('keyword')}}"
                            name="keyword"
                            class="form-control col-md-10"
                            type="text"
                            placeholder="Filter berdasarkan email"/>                   
                    </div>
                    <div class="col-md-6">
                        <input {{Request::get('status') == 'ACTIVE' ? 'checked' : ''}}
                            type="radio" 
                            name="status" 
                            id="active"
                            value="ACTIVE"
                            class="form-control">
                        <label for="active">Active</label>

                        <input {{Request::get('status') == 'INACTIVE' ? 'checked' : ''}}
                            type="radio" 
                            name="status" 
                            id="inactive"
                            value="INACTIVE"
                            class="form-control">
                        <label for="inactive">Inactive</label>

                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>
            <br>

    <table class="table table-bordered">
    <thead>
        <tr>
            <th><b>Name</b></th>
            <th><b>Username</b></th>
            <th><b>Email</b></th>
            <th><b>Avatar</b></th>
            <th><b>Action</b></th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->email}}</td>
            <td>@if($user->avatar)
                <img src="{{asset('storage/'.$user->avatar)}}" width="70px"/>
                @else
                N/A
                @endif</td>
                <td>
                    @if($user->status == "ACTIVE")
                    <span class="badge badge-success">
                        {{$user->status}}
                    </span>
                @else
                    <span class="badge badge-danger">
                        {{$user->status}}
                    </span>
                @endif
                </td>
            <td>
                <a class="btn btn-info text-white btn-sm" href="{{route('users.edit', ['id'=>$user->id])}}">Edit</a>
                <form
                    onsubmit="return confirm('Delete this user permanently?')"
                    class="d-inline"
                    action="{{route('users.destroy', ['id' => $user->id ])}}"
                    method="POST">
                @csrf

                <input
                    type="hidden"
                    name="_method"
                    value="DELETE">

                <input
                    type="submit"
                    value="Delete"
                    class="btn btn-danger btn-sm">
                </form>

                <a
                    href="{{route('users.show', ['id' => $user->id])}}"
                    class="btn btn-primary btn-sm">Detail</a>
            </td>
        </tr>
    @endforeach
    </tbody>
    <!-- <tfoot>
        <tr>
            <td colspan="10">
                {{$users->appends(Request::all())->links()}}
            </td>
        </tr>
    </tfoot> -->
    </table>
    {{ $users->appends(Request::all())->links() }}

@endsection