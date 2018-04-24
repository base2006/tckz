@extends('layouts.app')

@section('title', 'Show Event')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $event->name }}{{ !empty($event->subtitle) ? ' - '.$event->subtitle : '' }}</h3>
            <small>{{ ($event->active == 1) ? 'Active' : 'Not Active' }}</small>
            <p class="card-text">
                {{ $event->description }}<br>
                Event starts at: {{ $event->starts_at }}<br>
                Event ends at: {{ $event->ends_at }}<br>
                Location: {{ $event->location }}
            </p>
            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-accent"><i class="material-icons">edit</i> Edit Event</a>
        </div>
    </div>
@endsection