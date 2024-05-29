<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Submission;

class FileController extends Controller
{
    public function show($id, $type)
    {
        $submission = Submission::findOrFail($id);

        // Tentukan nama kolom file berdasarkan tipe yang diinginkan
        $column = $this->getColumnNameByType($type);

        // Dapatkan URL file dari kolom yang ditentukan
        $fileUrl = $submission->{$column};

        return redirect($fileUrl);
    }

    public function showfile($id, $type)
    {
        $submission = Submission::findOrFail($id);

        // Tentukan nama kolom file berdasarkan tipe yang diinginkan
        $column = $this->file($type);

        // Dapatkan nama file dari kolom yang ditentukan
        $filename = $submission->{$column};

        // Tentukan path file berdasarkan tipe
        $filePath = 'sk_file/' . $filename;

        // Periksa apakah file ada
        if (Storage::exists($filePath)) {
            // Jika file ada, kembalikan file untuk ditampilkan
            return response()->file(storage_path('app/' . $filePath));
        } else {
            // Jika file tidak ditemukan, berikan respons 404 Not Found
            abort(404);
        }
    }


    private function getColumnNameByType($type)
    {
        // Tentukan nama kolom berdasarkan tipe yang diinginkan
        $columns = [
            'application_letter' => 'application_letter',
            'documentation' => 'documentation',
            'tanah' => 'tanah',
            'rab' => 'rab',
            'land_certificate' => 'land_certificate',
            'management_letter' => 'management_letter',
            'notaris' => 'notaris',
            'npwp' => 'npwp',
            'domicile_letter' => 'domicile_letter',
            'sk_file' => 'sk_file',
            // ... tambahkan tipe file lainnya sesuai kebutuhan
        ];

        return $columns[$type];
    }

    private function file($type)
    {
        // Tentukan nama kolom berdasarkan tipe yang diinginkan
        $columns = [
            'application_letter' => 'application_letter',
            'documentation' => 'documentation',
            'tanah' => 'tanah',
            'rab' => 'rab',
            'land_certificate' => 'land_certificate',
            'management_letter' => 'management_letter',
            'notaris' => 'notaris',
            'npwp' => 'npwp',
            'domicile_letter' => 'domicile_letter',
            'sk_file' => 'sk_file',
            // ... tambahkan tipe file lainnya sesuai kebutuhan
        ];

        return $columns[$type];
    }
}
