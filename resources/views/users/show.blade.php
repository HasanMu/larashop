@extends('layouts.global')

@section('title') Detail User @endsection

@section('content')

    <table class="table">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>Avatar</td>
            <td>:</td>
            <td>@if($user->avatar)
                <img src="{{asset('storage/'.$user->avatar)}}" width="130px;">
                @else
                    N/A
                @endif</td>
        </tr>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td>{{ $user->username }}</td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>:</td>
            <td>@if($user->phone)
                {{ $user->phone }}
                @else
                    N/A
                @endif
                </td>
        </tr>
        <tr>
            <td>Address</td>
            <td>:</td>
            <td>{{ $user->address }}</td>
        </tr>
        <tr>
            <td>Roles</td>
            <td>:</td>
            <td>@foreach (json_decode($user->roles) as $role)
                &middot; {{$role}} <br>
                @endforeach
            </td>
        </tr>
    </table>

@endsection