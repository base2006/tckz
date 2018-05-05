<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();

        return view('events.index')->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:"H:i"',
            'end_date' => 'required|date',
            'end_time' => 'required|date_format:"H:i"',
            'image' => 'image|mimes:jpg,jpeg,png'
        ]);

        $event = new Event();

        $event->name = $request->name;
        $event->subtitle = $request->subtitle;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->starts_at = Carbon::createFromFormat('Y-m-d H:i', $request->start_date . ' ' . $request->start_time);
        $event->ends_at = Carbon::createFromFormat('Y-m-d H:i', $request->end_date . ' ' . $request->end_time);
        $event->is_active = $request->active ?? 0;

        $event->save();

        if (!empty($request->image)) {
            $event->addMediaFromRequest('image')->toMediaCollection();
        }

        return redirect()->route('events.index')->with('success', 'The event has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $eventImage = $event->getFirstMedia();

        return view('events.show')->with('event', $event)->with('evenImage', $eventImage);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $eventImage = $event->getFirstMedia();

        if (!empty($eventImage)) {
            $eventImage = $eventImage->getUrl();
        }

        $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $event->starts_at)->format('Y-m-d');
        $start_time = Carbon::createFromFormat('Y-m-d H:i:s', $event->starts_at)->format('H:i');
        $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $event->ends_at)->format('Y-m-d');
        $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $event->ends_at)->format('H:i');

        return view('events.edit')->with(compact(['event', 'eventImage', 'start_date', 'start_time', 'end_date', 'end_time']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:"H:i"',
            'end_date' => 'required|date',
            'end_time' => 'required|date_format:"H:i"',
            'image' => 'image|mimes:jpg,jpeg,png'
        ]);

        $event = Event::find($id);

        $event->name = $request->name;
        $event->subtitle = $request->subtitle;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->starts_at = Carbon::createFromFormat('Y-m-d H:i', $request->start_date . ' ' . $request->start_time);
        $event->ends_at = Carbon::createFromFormat('Y-m-d H:i', $request->end_date . ' ' . $request->end_time);
        $event->is_active = $request->active ?? 0;

        $event->save();

        if (!empty($request->event_image)) {
            $event->clearMediaCollection();
            $event->addMediaFromRequest('event_image')->toMediaCollection();
        } else if (isset($request->removed_image) && $request->removed_image == 1) {
            $event->clearMediaCollection();
        }

        return redirect()->route('events.index')->with('success', 'The event has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        $event->delete();

        $success = "The event has been deleted successfully.";

        return redirect()->route('events.index')->with('success', $success);
    }

    public function trashed()
    {
        $events = Event::onlyTrashed();

        return view('events.trashed')->with('events', $events);
    }

    public function restore($id)
    {
        $event = Event::onlyTrashed()->where('id', $id)->first();

        $event->restore();

        $success = "The event has been restored successfully.";

        return redirect()->route('events.index')->with('success', $success);
    }

    public function forceDestroy($id)
    {
        $event = Event::onlyTrashed()->where('id', $id)->first();

        $event->forceDelete();

        $success = "The event has been deleted successfully.";

        return redirect()->route('events.trashed')->with('success', $success);
    }
}
