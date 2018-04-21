@extends('layouts.app')

@section('title', 'Create User')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Create User</h3>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="What's your name?"
                           value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="What's your emailaddress?" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option>Select a role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ (old('role') == $role->name) ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Enter a password.">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                           placeholder="Confirm your password.">
                </div>

                <button type="submit" class="btn btn-accent"><i class="material-icons">person</i> Create User</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-warning"><i class="material-icons">cancel</i> Cancel</a>
            </form>
        </div>
    </div>
@endsection