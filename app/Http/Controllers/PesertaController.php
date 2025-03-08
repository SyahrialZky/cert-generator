<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PesertaController extends Controller
{
    public function index()
    {
        return view('pages.peserta.index');
    }
    public function getData()
    {
        $data = Participant::with('event')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('event_nama', function ($row) {
                return $row->event ? $row->event->nama : 'Tidak Ada Event';
            })
            ->rawColumns(['event_nama'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'event_id' => 'required|exists:events,id',
            'sebagai' => 'required|string|max:100',
        ]);

        $participant = Participant::create($request->all());

        return response()->json($participant, 201);
    }

    public function show($id)
    {
        $participant = Participant::with('event')->find($id);

        if (!$participant) {
            return response()->json(['message' => 'Participant not found'], 404);
        }

        return response()->json($participant, 200);
    }

    public function update(Request $request, $id)
    {
        $participant = Participant::find($id);

        if (!$participant) {
            return response()->json(['message' => 'Participant not found'], 404);
        }

        $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:participants,email,' . $id,
            'event_id' => 'sometimes|required|exists:events,id',
            'sebagai' => 'sometimes|required|string|max:100',
        ]);

        $participant->update($request->all());

        return response()->json($participant, 200);
    }

    public function destroy($id)
    {
        $participant = Participant::find($id);

        if (!$participant) {
            return response()->json(['message' => 'Participant not found'], 404);
        }

        $participant->delete();

        return response()->json(['message' => 'Participant deleted'], 200);
    }
}
