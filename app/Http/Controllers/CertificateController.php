<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
    }
    public function certificateChecker()
    {
        return view('pages.checker.index');
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


    // public function generateCertificate(Request $request)
    // {
    //     try {
    //         $event = DB::table('events')->where('id', $request->input('event'))->first();
    //         if ($event && $event->isGenerated) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Certificates have already been generated for this event. Regeneration is not allowed.'
    //             ], 400);
    //         }

    //         $template = DB::table('templates')
    //             ->where('id', $request->input('template'))
    //             ->select('file_path')
    //             ->first();
    //         $peserta = DB::table('participants')
    //             ->where('event_id', $event->id)
    //             ->select('id', 'nama', 'sebagai')
    //             ->get();
    //         $eventDate = $request->input('tanggal', now()->format('d F Y'));

    //         if (!$event || !$template || $peserta->isEmpty()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Event, template, or participants data is missing.'
    //             ], 400);
    //         }

    //         $manager = ImageManager::gd();
    //         $certificates = [];
    //         $templatePath = public_path('storage/' . $template->file_path);
    //         $fontPath = public_path('font/ArialMdm.ttf');

    //         $zipFileName = 'certificates_' . $event->id . '_' . date('Ymd_His') . '.zip';
    //         Storage::makeDirectory('public/certificates');
    //         $zipFilePath = storage_path('app/public/certificates/' . $zipFileName);

    //         $zip = new \ZipArchive();
    //         if ($zip->open($zipFilePath, \ZipArchive::CREATE) !== TRUE) {
    //             throw new \Exception("Cannot create zip file");
    //         }

    //         foreach ($peserta as $p) {
    //             $certificateNumber = $this->generateCertificateNumber();
    //             $image = $manager->read($templatePath);

    //             $image = $image->text($certificateNumber, 213, 189, function ($font) use ($fontPath) {
    //                 $font->file($fontPath);
    //                 $font->size(20);
    //                 $font->color('#000000');
    //             });

    //             $image = $image->text($p->nama, 310, 240, function ($font) use ($fontPath) {
    //                 $font->file($fontPath);
    //                 $font->size(22);
    //                 $font->color('#000000');
    //             });

    //             $image = $image->text($p->sebagai, 400, 323, function ($font) use ($fontPath) {
    //                 $font->file($fontPath);
    //                 $font->size(22);
    //                 $font->color('#000000');
    //             });

    //             $image = $image->text($eventDate, 355, 397, function ($font) use ($fontPath) {
    //                 $font->file($fontPath);
    //                 $font->size(20);
    //                 $font->color('#000000');
    //             });

    //             $safeNama = preg_replace('/[^A-Za-z0-9\-]/', '-', $p->nama);
    //             $filename = 'certificate-' . $safeNama . '-' . $certificateNumber . '.png';
    //             $filePath = 'public/certificates/' . $filename;

    //             $certImage = $image->toPng();
    //             Storage::put($filePath, $certImage);

    //             $zip->addFromString($filename, $certImage);

    //             DB::table('participants')
    //                 ->where('id', $p->id)
    //                 ->update([
    //                     'certificate' => $filePath,
    //                     'certificate_number' => $certificateNumber
    //                 ]);

    //             $certificates[] = [
    //                 'name' => $p->nama,
    //                 'certificateNumber' => $certificateNumber,
    //                 'certificateUrl' => asset('storage/certificates/' . $filename),
    //             ];
    //         }

    //         $zip->close();

    //         DB::table('events')->where('id', $event->id)->update([
    //             'isGenerated' => true
    //         ]);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Certificates generated successfully',
    //             'certificates' => $certificates,
    //             'zipUrl' => asset('storage/certificates/' . $zipFileName)
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error generating certificate',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    // private function generateCertificateNumber()
    // {
    //     $prefix = "CERT";
    //     $timestamp = substr(now()->timestamp, -6);
    //     $random = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    //     return $prefix . '-' . $timestamp . '-' . $random;
    // }
    public function generateCertificate(Request $request)
{
    try {
        $event = DB::table('events')->where('id', $request->input('event'))->first();

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found.'
            ], 404);
        }

        if ($event->isGenerated) {
            return response()->json([
                'success' => false,
                'message' => 'Certificates have already been generated for this event. Regeneration is not allowed.'
            ], 400);
        }

        $template = DB::table('templates')
            ->where('id', $request->input('template'))
            ->select('file_path')
            ->first();

        if (!$template) {
            return response()->json([
                'success' => false,
                'message' => 'Template not found.'
            ], 404);
        }

        $peserta = DB::table('participants')
            ->where('event_id', $event->id)
            ->select('id', 'nama', 'sebagai')
            ->get();

        if ($peserta->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No participants found for this event.'
            ], 404);
        }

        $eventDate = $request->input('tanggal', now()->format('d F Y'));

        $manager = ImageManager::gd();
        $certificates = [];

        $templatePath = public_path('storage/' . $template->file_path);
        if (!file_exists($templatePath)) {
            throw new \Exception("Template file not found at path: $templatePath");
        }

        $fontPath = public_path('font/ArialMdm.ttf');
        if (!file_exists($fontPath)) {
            throw new \Exception("Font file not found at path: $fontPath");
        }

        try {
            $imageTest = $manager->read($templatePath);
        } catch (\Throwable $e) {
            throw new \Exception("Unable to decode input template image: " . $e->getMessage());
        }

        $zipFileName = 'certificates_' . $event->id . '_' . date('Ymd_His') . '.zip';
        Storage::makeDirectory('public/certificates');
        $zipFilePath = storage_path('app/public/certificates/' . $zipFileName);

        $zip = new \ZipArchive();
        if ($zip->open($zipFilePath, \ZipArchive::CREATE) !== TRUE) {
            throw new \Exception("Cannot create zip file at $zipFilePath");
        }

        foreach ($peserta as $p) {
            $certificateNumber = $this->generateCertificateNumber();
            $image = $manager->read($templatePath);

            $image = $image->text($certificateNumber, 215, 244, function ($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(20);
                $font->color('#000000');
            });

            $image = $image->text($p->nama, 257, 298, function ($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(22);
                $font->color('#000000');
            });

            // $image = $image->text($p->sebagai, 400, 323, function ($font) use ($fontPath) {
            //     $font->file($fontPath);
            //     $font->size(22);
            //     $font->color('#000000');
            // });

            $image = $image->text($eventDate, 305, 388, function ($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(20);
                $font->color('#000000');
            });

            $safeNama = preg_replace('/[^A-Za-z0-9\-]/', '-', $p->nama);
            $filename = 'certificate-' . $safeNama . '-' . $certificateNumber . '.png';
            $filePath = 'public/certificates/' . $filename;

            $certImage = $image->toPng();
            Storage::put($filePath, $certImage);

            $zip->addFromString($filename, $certImage);

            DB::table('participants')
                ->where('id', $p->id)
                ->update([
                    'certificate' => $filePath,
                    'certificate_number' => $certificateNumber
                ]);

            $certificates[] = [
                'name' => $p->nama,
                'certificateNumber' => $certificateNumber,
                'certificateUrl' => asset('storage/certificates/' . $filename),
            ];
        }

        $zip->close();

        // DB::table('events')->where('id', $event->id)->update([
        //     'isGenerated' => true
        // ]);

        return response()->json([
            'success' => true,
            'message' => 'Certificates generated successfully',
            'certificates' => $certificates,
            'zipUrl' => asset('storage/certificates/' . $zipFileName)
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error generating certificate',
            'error' => $e->getMessage()
        ], 500);
    }
}

private function generateCertificateNumber()
{
    $prefix = "CERT";
    $timestamp = substr(now()->timestamp, -6);
    $random = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    return $prefix . '-' . $timestamp . '-' . $random;
}


    public function checkCertificateNumber(Request $request)
    {
        $certificateNumber = $request->input('certificate_number');

        $participant = DB::table('participants')
            ->where('certificate_number', $certificateNumber)
            ->first();

        if ($participant) {
            return response()->json([
                'success' => true,
                'message' => 'Certificate number is valid',
                'participant' => $participant
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid certificate number'
            ], 400);
        }
    }
}
