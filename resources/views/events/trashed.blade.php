@extends('layouts.app')

@section('title', 'Trashed Events')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Trashed Events</h3>
            <div class="row">
                <table id="users-table" class="table table-striped" cellspacing="0">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Subtitle</th>
                        <th scope="col">Description</th>
                        <th scope="col">Location</th>
                        <th scope="col">Starts at</th>
                        <th scope="col">Ends at</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $event)
                        <tr>
                            <th>{{ $event->id }}</th>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->subtitle }}</td>
                            <td>{{ $event->description }}</td>
                            <td>{{ $event->starts_at }}</td>
                            <td>{{ $event->ends_at }}</td>
                            <td>{{ $event->location }}</td>
                            <td class="text-right">
                                <form action="{{ route('events.restore', $event->id) }}" method="POST" class="d-inline-block">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-sm btn-accent">
                                        <i class="material-icons">restore</i>
                                    </button>
                                </form>
                                <form action="{{ route('events.delete-forever', $event->id) }}" method="POST" class="d-inline-block">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this event?')">
                                        <i class="material-icons">delete_forever</i>
                                    </button>
                                </form>
                            </td>
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
            $('#events-table').DataTable({
                searching: false,
                paging: false,
                "columns": [
                    null,
                    null,
                    null,
                    null,
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