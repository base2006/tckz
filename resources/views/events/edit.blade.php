@extends('layouts.app')

@section('title', 'Update Event')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Update Event</h3>
            <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                           placeholder="Event name"
                           value="{{ old('name') ?? $event->name }}">
                </div>
                <div class="form-group">
                    <label for="subtitle">Subtitle</label>
                    <input type="text" class="form-control" id="subtitle" name="subtitle"
                           placeholder="Event subtitle" value="{{ old('subtitle') ?? $event->subtitle }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" cols="30" rows="10"
                              placeholder="Description of your event">{{ old('description') ?? $event->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location"
                           placeholder="Enter your address" onFocus="geolocate()"
                           value="{{ old('location') ?? $event->location }}">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="start_date">Start date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                               value="{{ old('start_date') ?? $start_date }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="start_time">Start time</label>
                        <input type="time" class="form-control" id="start_time" name="start_time"
                               value="{{ old('start_time') ?? $start_time }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="end_date">End date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                               value="{{ old('end_date') ?? $end_date }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_time">End time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time"
                               value="{{ old('end_time') ?? $end_time }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="event_image">Event Image</label>
                    @if(!empty($eventImage))
                        <br>
                        <button class="remove-image material-icons" type="button">
                            <img src="{{ $eventImage }}" class="img-fluid" alt="Event image">
                        </button>
                        <input type="checkbox" id="removed-image" class="d-none" name="removed_image" value="1">
                    @endif
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile02" name="event_image">
                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Activate event</label>
                    @if(!empty(old('active')))
                        <input type="checkbox" class="switch" id="switch" name="active"
                               value="1" {{ (old('active') == 1) ? 'checked' : '' }}/>
                    @else
                        <input type="checkbox" class="switch" id="switch" name="active"
                               value="1" {{ ($event->is_active == 1) ? 'checked' : '' }}/>
                    @endif
                    <label class="switch-label" for="switch">Toggle</label>
                </div>
                <button type="submit" class="btn btn-accent"><i class="material-icons">event</i> Update Event</button>
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

        $(document).ready(function () {
            var date = new Date(),
                y = date.getFullYear(),
                m = date.getMonth(),
                d = date.getDate();
            $('input[type="date"]').attr('min', y + '-' + m + '-' + d);


            $('.remove-image').click(function () {
                $('#removed-image').prop('checked', true);
                $('.remove-image').fadeOut('slow', function () {
                    $(this).remove();
                });
            });

        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx18INVg2Oi_d5VjJEAcpqdpS810cFYZg&libraries=places&callback=initAutocomplete"
            async defer></script>
@endpush