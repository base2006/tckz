@extends('layouts.app')

@section('title', 'Create User')

@section('styles')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css"/>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Create Event</h3>
            <form action="{{ route('events.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                           placeholder="Event name"
                           value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="subtitle">Subtitle</label>
                    <input type="text" class="form-control" id="subtitle" name="subtitle"
                           placeholder="Event subtitle" value="{{ old('subtitle') }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" cols="30" rows="10"
                              placeholder="Description of your event">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location"
                           placeholder="Enter your address" onFocus="geolocate()" value="{{ old('location') }}">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="start_date">Start date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                               value="{{ old('start_date') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="start_time">Start time</label>
                        <input type="time" class="form-control" id="start_time" name="start_time"
                               value="{{ old('start_time') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="end_date">End date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                               value="{{ old('end_date') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_time">End time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time"
                               value="{{ old('end_time') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="event_image">Event Image</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile02" name="event_image">
                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Activate event</label>
                    <input type="checkbox" class="switch" id="switch" name="active" {{ (old('active') == true) ? 'checked' : '' }}/>
                    <label class="switch-label" for="switch">Toggle</label>
                </div>
                <button type="submit" class="btn btn-accent"><i class="material-icons">event</i> Create Event</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-warning"><i class="material-icons">cancel</i>
                    Cancel</a>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // This example displays an address form, using the autocomplete feature
        // of the Google Places API to help users fill in the information.

        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        var autocomplete;

        function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('location')),
                {types: ['geocode']});
        }

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx18INVg2Oi_d5VjJEAcpqdpS810cFYZg&libraries=places&callback=initAutocomplete"
            async defer></script>
@endpush