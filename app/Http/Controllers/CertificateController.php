<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Certificate::all());
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

    public function generateCertificate(Request $request)
    {
        try {
            $names = $request->input('names');
            $appreciation = $request->input('appreciation', 'Peserta');
            $eventDate = $request->input('eventDate', now()->format('d F Y'));

            if (!is_array($names) || empty($names)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Names array is required.'
                ], 400);
            }

            $manager = ImageManager::gd();
            $certificates = [];

            foreach ($names as $name) {
                $certificateNumber = $this->generateCertificateNumber();
                $templatePath = public_path('images/template.png');
                $image = $manager->read($templatePath);

                $fontPath = public_path('font/arial.ttf');

                $image = $image->text($certificateNumber, 213, 189, function ($font) use ($fontPath) {
                    $font->file($fontPath);
                    $font->size(20);
                    $font->color('#000000');
                });

                $image = $image->text($name, 310, 240, function ($font) use ($fontPath) {
                    $font->file($fontPath);
                    $font->size(22);
                    $font->color('#000000');
                });

                $image = $image->text($appreciation, 400, 323, function ($font) use ($fontPath) {
                    $font->file($fontPath);
                    $font->size(22);
                    $font->color('#000000');
                });

                $image = $image->text($eventDate, 355, 397, function ($font) use ($fontPath) {
                    $font->file($fontPath);
                    $font->size(20);
                    $font->color('#000000');
                });

                $filename = 'certificate-' . $certificateNumber . '.png';
                $filePath = 'public/certificates/' . $filename;

                Storage::makeDirectory('public/certificates');
                $image->toPng()->save(storage_path('app/' . $filePath));

                $certificates[] = [
                    'name' => $name,
                    'certificateNumber' => $certificateNumber,
                    'certificateUrl' => asset('storage/certificates/' . $filename),
                ];
            }

            return response()->json([
                'success' => true,
                'certificates' => $certificates
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
}
