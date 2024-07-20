<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Map;
use App\Models\surat_kelurahan;
use Illuminate\Support\Facades\Session;
use App\Models\Submission;


class KelurahanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role !== 'kelurahan') {
            abort(403, 'Unauthorized action.');
        }

        // Mengambil data peta yang terkait dengan submissions milik user dengan peran "masyarakat"
        $maps = Map::whereHas('submission', function ($query) {
            $query->whereHas('user', function ($query) {
                $query->where('role', 'masyarakat');
            });
        })->with('submission')->get();

        $coordinates = $maps->map(function ($map) {
            return [
                'latitude' => $map->latitude,
                'longitude' => $map->longitude,
                'submission' => $map->submission,
            ];
        })->toArray();

        // Mengambil submissions yang terkait dengan user kelurahan yang sedang login
        $submissions = Submission::where('user_id', $user->id)->get();

        return view('kelurahan.index', compact('submissions', 'coordinates'));
    }


    public function permohonan()
    {
        $submissions = Submission::all();


        return view('kelurahan.daftar_permohonan', ['submissions' => $submissions]);
    }
    public function profilkelurahan()
    {
        $user = Auth::user();
        $avatar = $user->avatar; // Mengambil avatar dari model pengguna

        return view('kelurahan.profil', compact('user', 'avatar'));
    }

    public function pengajuan()
    {
        $existingSubmission = Submission::where('user_id', auth()->id())->first();
        return view('kelurahan.permohonan', compact('existingSubmission'));
    }


    public function store(Request $request, $submissionId)
    {
        // Validasi request
        $request->validate([
            'file_kelurahan' => 'required|file|mimes:pdf,doc,docx|max:2048', // Contoh validasi untuk jenis file tertentu
        ]);

        // Simpan file ke storage (misalnya folder 'public/surat_kelurahan')
        if ($request->hasFile('file_kelurahan')) {
            $file = $request->file('file_kelurahan');
            $fileName = $file->getClientOriginalName(); // Ambil nama asli file
            $filePath = $file->storeAs('public/surat_kelurahan', $fileName); // Simpan dengan nama asli

            // Simpan data surat_kelurahan ke database
            surat_kelurahan::create([
                'submission_id' => $submissionId,
                'file_kelurahan' => $fileName, // Simpan nama file saja, bukan full path
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
        $file_path = storage_path('app/public/surat_kelurahan/' . $submission->surat_kelurahan->file_kelurahan);

        if (file_exists($file_path)) {
            return response()->file($file_path);
        } else {
            abort(404); // Jika file tidak ditemukan, tampilkan error 404
        }
    }

    public function download($id)
    {
        $submission = Submission::findOrFail($id);
        $file_path = storage_path('app/public/surat_kelurahan/' . $submission->surat_kelurahan->file_kelurahan);
        return response()->download($file_path);
    }

    public function file($id)
    {
        // Ambil data submission berdasarkan ID
        $submission = Submission::findOrFail($id);

        // Lalu kembalikan view atau lakukan aksi lainnya
        return view('kelurahan.file', ['submission' => $submission]);
    }

    public function detailpemohon($id)
    {
        $submission = Submission::find($id);

        if (!$submission) {
            return redirect()->back()->with('error', 'Submission not found.');
        }

        return view('kelurahan.detail_pemohon', compact('submission'));
    }

    public function kelurahanupdateStatus($id, $status)
    {
        $submission = Submission::findOrFail($id);

        if ($status == 'diketahui' && !$submission->surat_kelurahan) {
            alert()->error('Silahkan Upload Surat Terlebih Dahulu', 'Coba Lagi');
            return redirect()->route('detail.pemohon', $id);
        }

        $submission->status = $status;
        $submission->save();

        $message = $status == 'ditolak' ? 'Permohonan ditolak' : 'Permohonan diterima';
        alert()->success($message, 'Berhasil');
        return redirect()->route('detail.pemohon', $id);
    }
}
