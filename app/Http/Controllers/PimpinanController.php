<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
use Auth;
use App\Models\Submission;
use App\Models\otorisasi;
use App\Models\suratpimpinan;

class PimpinanController extends Controller
{
    public function index()
    {
        $maps = Map::with('submission')->get();
        $coordinates = [];

        foreach ($maps as $map) {
            $coordinates[] = [
                'latitude' => $map->latitude,
                'longitude' => $map->longitude,
                'submission' => $map->submission,
            ];
        }
        return view('pimpinan.index', compact('coordinates'));
    }

    public function profilpimpinan()
    {
        $user = Auth::user();
        $avatar = $user->avatar; // Mengambil avatar dari model pengguna

        return view('pimpinan.profil', compact('user', 'avatar'));
    }

    public function datapermohonan()
    {
        $submissions = Submission::all();


        return view('pimpinan.data_permohonan', ['submissions' => $submissions]);
    }

    public function detaildata($id)
    {
        $submission = Submission::find($id);

        if (!$submission) {
            return redirect()->back()->with('error', 'Submission not found.');
        }

        return view('pimpinan.detail_data', compact('submission'));
    }

    public function store(Request $request, $submissionId)
    {
        // Validasi request
        $request->validate([
            'file_pimpinan' => 'required|file|mimes:pdf,doc,docx|max:2048', // Contoh validasi untuk jenis file tertentu
        ]);

        // Simpan file ke storage (misalnya folder 'public/surat_pimpinan')
        if ($request->hasFile('file_pimpinan')) {
            $file = $request->file('file_pimpinan');
            $fileName = $file->getClientOriginalName(); // Ambil nama asli file
            $filePath = $file->storeAs('public/suratpimpinan', $fileName); // Simpan dengan nama asli

            // Simpan data suratpimpinan ke database
            suratpimpinan::create([
                'submission_id' => $submissionId,
                'file_pimpinan' => $fileName, // Simpan nama file saja, bukan full path
            ]);

            toast('Berhasil Upload Surat', 'success');
        } else {
            toast('Gagal Upload Surat', 'error');
        }

        return redirect()->back();
    }

    public function show($id)
    {
        $submission = Submission::findOrFail($id);
        $file_path = storage_path('app/public/suratpimpinan/' . $submission->suratpimpinan->file_pimpinan);

        if (file_exists($file_path)) {
            return response()->file($file_path);
        } else {
            abort(404); // Jika file tidak ditemukan, tampilkan error 404
        }
    }

    public function updateStatus($id, $status, Request $request)
    {
        $submission = Submission::findOrFail($id);

        // Cek jika status adalah 'diterima' dan belum ada surat pimpinan
        if ($status == 'diterima' && !$submission->suratpimpinan) {
            alert()->error('Silahkan Upload Surat Terlebih Dahulu', 'Coba Lagi');
            return redirect()->route('pimpinan.permohonan', $id);
        }

        // Cek jika status adalah 'diterima' dan tanggal penerimaan belum diinput
        if ($status == 'diterima' && !$request->input('otorisasi_pimpinan')) {
            alert()->error('Silahkan Masukkan Tanggal Penerimaan Terlebih Dahulu', 'Coba Lagi');
            return redirect()->route('pimpinan.permohonan', $id);
        }

        // Update status submission
        $submission->status = $status;
        $submission->save();

        // Menyimpan data otorisasi jika status diterima
        if ($status == 'diterima') {
            $otorisasi = new otorisasi();
            $otorisasi->submission_id = $submission->id;
            $otorisasi->otorisasi_pimpinan = $request->input('otorisasi_pimpinan');
            $otorisasi->save();
        }

        // Menampilkan pesan berhasil
        $message = $status == 'ditolak' ? 'Permohonan ditolak' : 'Permohonan diterima';
        alert()->success($message, 'Berhasil');
        return redirect()->route('pimpinan.permohonan', $id);
    }
}
