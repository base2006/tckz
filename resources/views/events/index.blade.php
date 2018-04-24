@extends('layouts.app')

@section('title', 'All Events')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">All Events</h3>
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
                        <th scope="col">Active</th>
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
                            <td>{{ ($event->active == 1) ? "Yes" : "No"  }}</td>
                            <td class="text-right">
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-accent">
                                    <i class="material-icons">edit</i>
                                </a>
                                <form action="{{ route('events.delete', $event->id) }}" method="POST" class="d-inline-block">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this event?')"><i
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