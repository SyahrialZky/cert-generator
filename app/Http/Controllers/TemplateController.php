<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;


class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.template.index');
    }
    public function getData()
    {
        $data = Template::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function show($id)
    {
        $template = Template::find($id);

        if (!$template) {
            return response()->json(['message' => 'Template not found'], 404);
        }

        return response()->json($template);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:png,jpg,jpeg,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
        $filePath = 'templates/' . $fileName;
        $request->file('file')->storeAs('public', $filePath);

        $template = Template::create([
            'name' => $request->name,
            'file_path' => $filePath,
        ]);

        return response()->json($template, 201);
    }

    /**
     * Display the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $template = Template::find($id);

        if (!$template) {
            return response()->json(['message' => 'Template tidak ditemukan'], 404);
        }

        // \Log::info("Update template ID: " . $id); aku ndebug id binding 

        if ($request->filled('name')) {
            $template->name = $request->name;
        }

        if ($request->hasFile('file')) {
            if ($template->file_path) {
                Storage::delete('public/' . $template->file_path);
            }

            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $filePath = 'templates/' . $fileName;
            $request->file('file')->storeAs('public', $filePath);

            $template->file_path = $filePath;
        }

        $template->save();

        return response()->json(['message' => 'Template berhasil diperbarui', 'template' => $template], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $template = Template::find($id);

        if (!$template) {
            return response()->json(['message' => 'Template not found'], 404);
        }

        Storage::delete('public/' . $template->file_path);

        $template->delete();

        return response()->json(['message' => 'Template deleted successfully'], 200);
    }
}
