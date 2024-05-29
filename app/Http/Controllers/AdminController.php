<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->guard('web')->user();
        $submissions = Submission::all();
        return view('admin.index', compact('submissions'));
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

        $submission->status = ($request->input('status') == 'disetujui') ? 'disetujui' : 'ditolak';
        $submission->note = $request->input('note');
        $submission->save();

        toast('Submission approved/rejected successfully.', 'success');
        return redirect()->route('admin.new');
    }

    public function destroy($id)
{
    $submission = Submission::findOrFail($id);

    // Hapus file terkait jika ada
    $fileFields = ['application_letter', 'documentation', 'tanah', 'rab', 'land_certificate', 'management_letter', 'notaris', 'npwp', 'domicile_letter'];

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
        // Temukan submission berdasarkan ID
        $submission = Submission::findOrFail($id);

        // Tampilkan form edit dengan data submission
        return view('admin.edit', ['submission' => $submission]);
    }
    public function file($id)
    {
        // Ambil data submission berdasarkan ID
        $submission = Submission::findOrFail($id);
    
        // Lalu kembalikan view atau lakukan aksi lainnya
        return view('admin.file', ['submission' => $submission]);
    }

    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nik' => 'required|numeric|unique:submissions,nik,' . $id,
        'name' => 'required|max:100',
        'address' => 'required',
        'ibadah' => 'required',
        'bank_name' => 'required',
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
    
    // Temukan submission berdasarkan ID
    $submission = Submission::findOrFail($id);

    // Update data submission
    $submission->update([
        // ... pembaruan kolom lainnya
        'application_letter' => $request->application_letter,
        // ... pembaruan kolom lainnya
    ]);

    // Update file jika diunggah
    if ($request->hasFile('application_letter')) {
        // Hapus file lama jika ada
        Storage::delete($submission->application_letter);

        // Simpan file yang baru di storage
        $submission->application_letter = $request->file('application_letter')->store('path/to/storage');
    }

    // Lakukan hal yang sama untuk file-file lainnya

    // Simpan perubahan
    $submission->save();

    // Tampilkan form edit atau tindakan lainnya sesuai kebutuhan
    return redirect()->route('admin.new')->with('success', 'Submission updated successfully');
}

public function uploadSk(Request $request, $id)
{
    // Validasi form jika diperlukan
    $request->validate([
        'sk_file' => 'required|mimes:pdf,doc,docx|max:10240', // Maksimal 10MB
    ]);

    // Proses penyimpanan file
    if ($request->hasFile('sk_file')) {
        $file = $request->file('sk_file');
        $filename = 'sk_' . $id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('sk_file', $filename,);

        // Simpan informasi file di database jika diperlukan
        $submission = Submission::findOrFail($id);
        $submission->sk_file = $filename;
        $submission->save();
    }

    // Redirect atau lakukan aksi lainnya
    return redirect()->route('admin.new')->with('success', 'File SK berhasil diupload.');
}
public function store(Request $request)
{
    $request->validate([
        'sk_file' => 'nullable|file|mimes:pdf|max:10240',
    ]);


    $sk_filePath = $request->file('sk_file')->store('sk_file');

    $submission = new Submission([
        'sk_file' => $sk_filePath,
    ]);
    $submission->user_id = auth()->id();
    $submission->save();

    toast('Success', 'success');
    return redirect('/admin/new');
}
}
