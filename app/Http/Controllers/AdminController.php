<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\Storage;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        $submissions = Submission::all();
        return view('admin.index', compact('submissions'));
    }

    public function status()
    {
        $submissions = Submission::all();
        return view('admin.submission-table', compact('submissions'));
    }

    public function show($id)
    {
        $submission = Submission::findOrFail($id);
        return view('admin.show', compact('submission'));
    }

    public function newSubmissions()
    {
        $newSubmissions = Submission::where('status', 'proses')->get();
        $approvedSubmissions = Submission::where('status', 'disetujui')->get();
        $rejectedSubmissions = Submission::where('status', 'ditolak')->get();

        return view('admin.new', compact('newSubmissions', 'approvedSubmissions', 'rejectedSubmissions'));
    }

    public function approveSubmission(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);

        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'note' => 'nullable|string',
        ]);

        $status = $request->input('status');
        $submission->status = $status;
        $submission->note = $request->input('note');
        $submission->save();

        if ($status == 'disetujui') {
            toast('Permohonan disetujui.', 'success');
        } else {
            toast('Permohonan ditolak.', 'error');
        }

        return redirect()->route('admin.new');
    }


    public function destroy($id)
    {
        $submission = Submission::findOrFail($id);

        // Hapus file terkait jika ada
        $fileFields = ['application_letter', 'documentation', 'tanah', 'rab', 'land_certificate', 'management_letter', 'notaris', 'npwp', 'domicile_letter', 'sk_file'];

        foreach ($fileFields as $field) {
            $file = $submission->$field;
            if ($file) {
                Storage::delete('public/' . $file);
            }
        }

        $submission->delete();

        return redirect()->route('admin.new')->with('success', 'Submission berhasil dihapus');
    }

    public function edit($id)
    {
        $submission = Submission::findOrFail($id);
        return view('admin.edit', compact('submission'));
    }

    public function file($id)
    {
        $submission = Submission::findOrFail($id);
        return view('admin.file', compact('submission'));
    }

    public function profiladmin()
    {
        $user = Auth::user();
        $avatar = $user->avatar; // Mengambil avatar dari model pengguna

        return view('admin.profil', compact('user', 'avatar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|numeric|unique:submissions,nik,' . $id,
            'name' => 'required|max:100',
            'address' => 'required',
            'ibadah' => 'required',
            'bank_name' => 'required',
            'kelurahan_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:submissions,email,' . $id,
            'budget' => 'required',
            'bank_account' => 'required',
            'application_letter' => 'nullable|file|mimes:pdf,doc,docx',
            'documentation' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'land_certificate' => 'nullable|file|mimes:pdf,doc,docx',
            'management_letter' => 'nullable|file|mimes:pdf,doc,docx',
            'notaris' => 'nullable|file|mimes:pdf,doc,docx',
            'npwp' => 'nullable|file|mimes:pdf',
            'domicile_letter' => 'nullable|file|mimes:pdf,doc,docx',
            'rab' => 'nullable|file|mimes:pdf,doc,docx',
            'tanah' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $submission = Submission::findOrFail($id);

        $submission->update($request->all());

        // Update file jika diunggah
        if ($request->hasFile('application_letter')) {
            $file = $request->file('application_letter');
            $filename = 'application_letter_' . $id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public', $filename);
            $submission->application_letter = $filename;
        }

        // Lakukan hal yang sama untuk file-file lainnya

        $submission->save();

        return redirect()->route('admin.new')->with('success', 'Submission updated successfully');
    }

    public function uploadSk(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'sk_file' => 'required|file|mimes:pdf,doc,docx|max:10240', // Sesuaikan dengan kebutuhan Anda
        ]);

        // Temukan submission berdasarkan ID
        $submission = Submission::findOrFail($id);

        // Proses penyimpanan file
        if ($request->hasFile('sk_file')) {
            $file = $request->file('sk_file');
            $filePath = $file->store('public/sk_files'); // Simpan file di dalam direktori 'public'

            // Simpan path file ke dalam model submission
            $submission->sk_file = $filePath;
            $submission->save();

            // Jika perlu, tambahkan respons atau redirect ke halaman yang sesuai
            toast('Upload Surat Berhasil.', 'success');
            return redirect()->back();
        }

        toast('Upload Surat Gagal.', 'error');
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'sk_file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $sk_filePath = $request->file('sk_file')->store('public/sk_files');

        $submission = new Submission([
            'sk_file' => $sk_filePath,
        ]);
        $submission->user_id = auth()->id();
        $submission->save();

        toast('Success', 'success');
        return redirect('/admin/new');
    }

    public function approvedSubmissions()
    {
        $approvedSubmissions = Submission::where('status', 'disetujui')->get();
        return view('admin.approved', compact('approvedSubmissions'));
    }

    public function rejectedSubmissions()
    {
        $rejectedSubmissions = Submission::where('status', 'ditolak')->get();
        return view('admin.rejected', compact('rejectedSubmissions'));
    }
    public function detail($id)
    {
        $submission = Submission::find($id);

        if (!$submission) {
            return redirect()->back()->with('error', 'Submission not found.');
        }

        return view('admin.detail', compact('submission'));
    }
}
