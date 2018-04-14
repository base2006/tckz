@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">My Profile</h3>
            <p class="card-text">
                Name: {{ $user->name }}<br>
                Email: {{ $user->email }}
            </p>
            <a href="{{ route('user.edit', Auth::user()->id) }}" class="btn btn-accent"><i class="material-icons">edit</i> Edit Profile</a>
        </div>
    </div>
@endsection