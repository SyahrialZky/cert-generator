<?php

namespace App\Http\Controllers;

use App\Imports\ParticipantImport;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;


class PesertaController extends Controller
{
    public function index()
    {
        $events = DB::table('events')->select('id', 'nama as name')->get();
        $template = DB::table('templates')->select('id', 'name')->get();
        return view('pages.peserta.index', compact('events', 'template'));
    }

    public function dataPeserta($id): JsonResponse
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event tidak ditemukan'
            ], 404);
        }

        $participants = Participant::where('event_id', $id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar peserta berhasil diambil',
            'event' => $event,
            'participants' => $participants
        ], 200);
    }

    public function importFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
            'event_id' => 'required|exists:events,id'
        ]);

        $event_id = $request->event_id;

        Excel::import(new ParticipantImport($event_id), $request->file('file'));

        return response()->json([
            'success' => true,
            'message' => 'Data peserta berhasil diimport'
        ]);
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
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|unique:participants,email',
                'event_id' => 'required|exists:events,id',
                'sebagai' => 'required|string|max:100',
            ]);
            $participant = Participant::create($request->all());
            $eventId = $request->event_id;
            return response()
                ->json([
                    'success' => true,
                    'message' => 'Peserta berhasil ditambahkan',
                    'participant' => $participant
                ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan peserta: ' . $e->getMessage()
            ], 500);
        }
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
