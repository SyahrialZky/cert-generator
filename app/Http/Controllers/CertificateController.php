<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
    }

    public function getData()
    {
        $data = Certificate::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'recipient_name' => 'required|string',
            'certificate_number' => 'required|unique:certificates',
            'event_name' => 'required|string',
            'issued_date' => 'required|date',
            'expiry_date' => 'nullable|date',
            'template_id' => 'required|exists:templates,id',
            'status' => 'required|in:active,revoked'
        ]);

        $certificate = Certificate::create($request->all());
        return response()->json($certificate, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Certificate::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->update($request->all());
        return response()->json($certificate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Certificate::destroy($id);
        return response()->json(['message' => 'Certificate deleted']);
    }
}
