<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use App\Models\Template;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    public function index()
    {
        return view('pages.event.index', ['events' => Event::all()]);
    }
    public function getData()
    {
        $data = Event::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function viewPeserta($id)
    {
        $events = Event::select('id', 'nama as name')->get();
        $template = Template::select('id', 'name')->get();
        return view('pages.event.detail', compact('events', 'template', 'id'));
    }


    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:255']);
        Event::create($request->all());
        return redirect()->route('event.index')->with('success', 'Event created successfully');
    }

    public function show($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        return response()->json($event, 200);
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $event->update($request->all());

        return redirect()->route('event.index')->with('success', 'Event updated successfully');
    }

    public function destroy($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $event->delete();

        return response()->json(['message' => 'Event deleted'], 200);
    }
}
