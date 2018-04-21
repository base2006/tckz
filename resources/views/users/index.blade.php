@extends('layouts.app')

@section('title', 'All Users')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">All Users</h3>
            <div class="row">
                <table id="users-table" class="table table-striped" cellspacing="0">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th>{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->getRoleNames()->first()) }}</td>
                            <td class="text-right">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-accent">
                                    <i class="material-icons">edit</i>
                                </a>
                                <form action="{{ route('users.delete', $user->id) }}" method="POST" class="d-inline-block">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-sm btn-danger {{ ($user->id == Auth::user()->id) ? 'disabled' : '' }}"
                                            onclick="return confirm('Are you sure you want to delete this user?')"><i
                                                class="material-icons">delete</i>
                                    </button>
                                </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#users-table').DataTable({
                searching: false,
                paging: false,
                "columns": [
                    null,
                    null,
                    null,
                    null,
                    {"orderable": false}
                ]
            });
        });
    </script>
@endpush