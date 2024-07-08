<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Map;
use Illuminate\Http\Request;
use Auth;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Auth::user()->submissions;

        return view('submissions.index', compact('submissions'));
    }

    public function create()
    {
        return view('submissions.create');
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

        $applicationLetterPath = $request->file('application_letter')->store('public/letters');
        $documentationPath = $request->file('documentation')->store('public/documentation');
        $landCertificatePath = $request->file('land_certificate')->store('public/certificates');
        $managementLetterPath = $request->file('management_letter') ? $request->file('management_letter')->store('public/letters') : null;
        $notarisPath = $request->file('notaris') ? $request->file('notaris')->store('public/notaris') : null;
        $npwpPath = $request->file('npwp')->store('public/npwp');
        $domicileLetterPath = $request->file('domicile_letter')->store('public/letters');
        $tanahPath = $request->file('tanah')->store('public/tanah');
        $rabPath = $request->file('rab')->store('public/rab');

        $submission = new Submission([
            'nik' => $request->input('nik'),
            'name' => $request->input('name'),
            'bank_name' => $request->input('bank_name'),
            'kelurahan_name' => $request->input('kelurahan_name'),
            'address' => $request->input('address'),
            'ibadah' => $request->input('ibadah'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'budget' => $request->input('budget'),
            'bank_account' => $request->input('bank_account'),
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
}
