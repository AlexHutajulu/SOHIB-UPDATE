<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\tanggalpengajuan;
use App\Models\kelurahan;
use App\Models\bank;
use App\Models\otorisasi;
use App\Models\Map;
use Illuminate\Http\Request;
use Auth;
use Storage;

class SubmissionController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $submissions = Submission::where('user_id', $userId)->with('tanggalpengajuan')->get();

        return view('submissions.index', compact('submissions'));
    }


    public function create()
    {
        $existingSubmission = Submission::where('user_id', auth()->id())->first();
        return view('submissions.create', compact('existingSubmission'));
    }

    public function show($id)
    {
        $submission = Submission::findOrFail($id);
        return view('submissions.profil', compact('submission'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:submissions|numeric',
            'name' => 'required|max:100',
            'address' => 'required',
            'kelurahan_name' => 'required',
            'ibadah' => 'required',
            'bank_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:submissions',
            'budget' => 'required',
            'bank_account' => 'required',
            'application_letter' => 'required|file',
            'documentation' => 'required|file',
            'land_certificate' => 'required|file',
            'management_letter' => 'nullable|file|mimes:pdf|max:10240',
            'notaris' => 'nullable|file|mimes:pdf|max:10240',
            'npwp' => 'required|file',
            'domicile_letter' => 'required|file',
            'rab' => 'required|file',
            'tanah' => 'required|file',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $existingSubmission = Submission::where('user_id', auth()->id())->exists();

        if ($existingSubmission) {
            return redirect()->route('submissions.index')
                ->with('error', 'Anda sudah mengajukan permohonan sebelumnya.');
        }

        $applicationLetterPath = $request->file('application_letter')->storeAs('public/letters', $request->file('application_letter')->getClientOriginalName());
        $documentationPath = $request->file('documentation')->storeAs('public/documentation', $request->file('documentation')->getClientOriginalName());
        $landCertificatePath = $request->file('land_certificate')->storeAs('public/certificates', $request->file('land_certificate')->getClientOriginalName());
        $managementLetterPath = $request->file('management_letter') ? $request->file('management_letter')->storeAs('public/letters', $request->file('management_letter')->getClientOriginalName()) : null;
        $notarisPath = $request->file('notaris') ? $request->file('notaris')->storeAs('public/notaris', $request->file('notaris')->getClientOriginalName()) : null;
        $npwpPath = $request->file('npwp')->storeAs('public/npwp', $request->file('npwp')->getClientOriginalName());
        $domicileLetterPath = $request->file('domicile_letter')->storeAs('public/letters', $request->file('domicile_letter')->getClientOriginalName());
        $tanahPath = $request->file('tanah')->storeAs('public/tanah', $request->file('tanah')->getClientOriginalName());
        $rabPath = $request->file('rab')->storeAs('public/rab', $request->file('rab')->getClientOriginalName());


        $submission = new Submission([
            'nik' => $request->input('nik'),
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'ibadah' => $request->input('ibadah'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'budget' => $request->input('budget'),
            'application_letter' => $applicationLetterPath,
            'documentation' => $documentationPath,
            'land_certificate' => $landCertificatePath,
            'management_letter' => $managementLetterPath,
            'notaris' => $notarisPath,
            'npwp' => $npwpPath,
            'domicile_letter' => $domicileLetterPath,
            'tanah' => $tanahPath,
            'rab' => $rabPath,
        ]);

        $submission->user_id = auth()->id();
        $submission->save();



        // Save latitude and longitude in the Map model
        $map = new Map();
        $map->submission_id = $submission->id;
        $map->latitude = $request->input('latitude');
        $map->longitude = $request->input('longitude');
        $map->save();

        // Save tanggal pengajuan
        $tanggalpengajuan = new tanggalpengajuan();
        $tanggalpengajuan->submission_id = $submission->id;
        $tanggalpengajuan->tanggal_pengajuan = $request->input('tanggal_pengajuan');
        $tanggalpengajuan->save();

        $kelurahan = new kelurahan();
        $kelurahan->submission_id = $submission->id;
        $kelurahan->kelurahan_name = $request->input('kelurahan_name');
        $kelurahan->save();

        $bank = new bank();
        $bank->submission_id = $submission->id;
        $bank->bank_name = $request->input('bank_name');
        $bank->bank_account = $request->input('bank_account');
        $bank->save();

        


        // Redirect based on user role
        if (auth()->user()->role === 'kelurahan') {
            toast('Permintaan Berhasil Ditambahkan.', 'success');
            return redirect()->route('kelurahan.index');
        } else {
            toast('Permintaan Berhasil Ditambahkan.', 'success');
            return redirect()->route('submissions.index');
        }
    }

    public function edit(Submission $submission)
    {
        //
    }

    public function update(Request $request, Submission $submission)
    {
        //
    }

    public function destroy(Submission $submission)
    {
        //
    }

    public function showFile($id, $type)
    {
        $submission = Submission::findOrFail($id);

        if (!$submission) {
            abort(404);
        }

        $file = null;

        switch ($type) {
            case 'application_letter':
                $file = $submission->application_letter;
                break;
            case 'documentation':
                $file = $submission->documentation;
                break;
            case 'tanah':
                $file = $submission->tanah;
                break;
            case 'land_certificate':
                $file = $submission->land_certificate;
                break;
            case 'management_letter':
                $file = $submission->management_letter;
                break;
            case 'skt':
                $file = $submission->management_letter;
                break;
            case 'notaris':
                $file = $submission->notaris;
                break;
            case 'npwp':
                $file = $submission->npwp;
                break;
            case 'domicile_letter':
                $file = $submission->domicile_letter;
                break;
            case 'rab':
                $file = $submission->rab;
                break;
            case 'sk_file':
                $file = $submission->sk_file;
                break;
            default:
                abort(404);
        }

        if (!$file || !\Storage::exists($file)) {
            abort(404);
        }

        return response()->file(storage_path('app/' . $file));
    }

    public function downloadFile($id, $type)
    {
        $submission = Submission::findOrFail($id);

        // Ambil nama file berdasarkan tipe
        switch ($type) {
            case 'application_letter':
                $file = $submission->application_letter;
                break;
            case 'documentation':
                $file = $submission->documentation;
                break;
            case 'tanah':
                $file = $submission->tanah;
                break;
            case 'rab':
                $file = $submission->rab;
                break;
            case 'land_certificate':
                $file = $submission->land_certificate;
                break;
            case 'management_letter':
                $file = $submission->management_letter;
                break;
            case 'skt':
                $file = $submission->management_letter;
                break;
            case 'notaris':
                $file = $submission->notaris;
                break;
            case 'npwp':
                $file = $submission->npwp;
                break;
            case 'domicile_letter':
                $file = $submission->domicile_letter;
                break;
            case 'sk_file':
                $file = $submission->sk_file;
                break;
            default:
                abort(404);
        }

        // Jika file tidak ada, tampilkan pesan
        if (!$file) {
            abort(404);
        }

        // Ambil path file
        $filePath = storage_path('app/' . $file);

        // Jika file tidak ditemukan, tampilkan pesan
        if (!file_exists($filePath)) {
            abort(404);
        }

        // Return response untuk download file
        return response()->download($filePath);
    }


    public function showResubmitForm($id)
    {
        $submission = Submission::findOrFail($id);
        // Ambil juga data terkait dari tabel terkait, seperti maps dan tanggalpengajuan
        $map = Map::where('submission_id', $submission->id)->first();
        $tanggalpengajuan = TanggalPengajuan::where('submission_id', $submission->id)->first();

        return view('submissions.ajukanulang', compact('submission', 'map', 'tanggalpengajuan'));
    }

    public function resubmit(Request $request, $id)
    {
        // Temukan submission yang akan diajukan ulang
        $submission = Submission::findOrFail($id);

        // Validasi form untuk pengajuan ulang
        $request->validate([
            'tanggal_pengajuan' => 'required|date',
            'kelurahan_name' => 'required',
            'ibadah' => 'required',
            'budget' => 'required',
            'bank_name' => 'required',
            'bank_account' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'application_letter' => 'nullable|file',
            'documentation' => 'nullable|file',
            'land_certificate' => 'nullable|file',
            'management_letter' => 'nullable|file|mimes:pdf|max:10240',
            'notaris' => 'nullable|file|mimes:pdf|max:10240',
            'npwp' => 'nullable|file',
            'domicile_letter' => 'nullable|file',
            'rab' => 'nullable|file',
            'tanah' => 'nullable|file',
        ]);

        // Update data submission yang ada di database
        $submission->update([
            'ibadah' => $request->ibadah,
            'budget' => $request->budget,
            'nik' => $request->nik,
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => 'proses', // Mengubah status menjadi 'proses'

        ]);

        // Update data pada tabel terkait (maps dan tanggalpengajuan)
        $map = Map::where('submission_id', $submission->id)->first();
        if ($map) {
            $map->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }

        $tanggalpengajuan = TanggalPengajuan::where('submission_id', $submission->id)->first();
        if ($tanggalpengajuan) {
            $tanggalpengajuan->update([
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
            ]);
        }

        $bank = bank::where('submission_id', $submission->id)->first();
        if ($bank) {
            $bank->update([
                'bank_name' => $request->bank_name,
                'bank_account' => $request->bank_account,
            ]);
        }

        $kelurahan = kelurahan::where('submission_id', $submission->id)->first();
        if ($kelurahan) {
            $kelurahan->update([
                'kelurahan_name' => $request->kelurahan_name,
            ]);
        }
        

        // Proses untuk menyimpan file-file jika diunggah
        if ($request->hasFile('application_letter')) {
            $applicationLetter = $request->file('application_letter');
            $applicationLetterPath = $applicationLetter->storeAs('public/letters', $applicationLetter->getClientOriginalName());
            Storage::delete($submission->application_letter);
            $submission->update(['application_letter' => $applicationLetterPath]);
        }

        if ($request->hasFile('documentation')) {
            $documentation = $request->file('documentation');
            $documentationPath = $documentation->storeAs('public/documentation', $documentation->getClientOriginalName());
            Storage::delete($submission->documentation);
            $submission->update(['documentation' => $documentationPath]);
        }

        if ($request->hasFile('land_certificate')) {
            $landCertificate = $request->file('land_certificate');
            $landCertificatePath = $landCertificate->storeAs('public/certificates', $landCertificate->getClientOriginalName());
            Storage::delete($submission->land_certificate);
            $submission->update(['land_certificate' => $landCertificatePath]);
        }

        if ($request->hasFile('management_letter')) {
            $managementLetter = $request->file('management_letter');
            $managementLetterPath = $managementLetter->storeAs('public/letters', $managementLetter->getClientOriginalName());
            Storage::delete($submission->management_letter);
            $submission->update(['management_letter' => $managementLetterPath]);
        }

        if ($request->hasFile('notaris')) {
            $notaris = $request->file('notaris');
            $notarisPath = $notaris->storeAs('public/notaris', $notaris->getClientOriginalName());
            Storage::delete($submission->notaris);
            $submission->update(['notaris' => $notarisPath]);
        }

        if ($request->hasFile('npwp')) {
            $npwp = $request->file('npwp');
            $npwpPath = $npwp->storeAs('public/npwp', $npwp->getClientOriginalName());
            Storage::delete($submission->npwp);
            $submission->update(['npwp' => $npwpPath]);
        }

        if ($request->hasFile('domicile_letter')) {
            $domicileLetter = $request->file('domicile_letter');
            $domicileLetterPath = $domicileLetter->storeAs('public/letters', $domicileLetter->getClientOriginalName());
            Storage::delete($submission->domicile_letter);
            $submission->update(['domicile_letter' => $domicileLetterPath]);
        }

        if ($request->hasFile('rab')) {
            $rab = $request->file('rab');
            $rabPath = $rab->storeAs('public/rab', $rab->getClientOriginalName());
            Storage::delete($submission->rab);
            $submission->update(['rab' => $rabPath]);
        }

        if ($request->hasFile('tanah')) {
            $tanah = $request->file('tanah');
            $tanahPath = $tanah->storeAs('public/tanah', $tanah->getClientOriginalName());
            Storage::delete($submission->tanah);
            $submission->update(['tanah' => $tanahPath]);
        }

        // Redirect ke halaman submissions.index dengan pesan sukses
        toast('Permohonan Berhasil Di Ajukan Ulang', 'success');
        return redirect()->route('submissions.index');
    }
}
