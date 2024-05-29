<?php

namespace App\Http\Controllers;

use App\Models\Submission;
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

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:submissions|numeric',
            'name' => 'required|max:100',
            'address' => 'required',
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
        ]);

        $applicationLetterPath = $request->file('application_letter')->store('letters');
        $documentationPath = $request->file('documentation')->store('documentation');
        $landCertificatePath = $request->file('land_certificate')->store('certificates');
        $managementLetterPath = $request->file('management_letter') ? $request->file('management_letter')->store('letters') : null;
        $notarisPath = $request->file('notaris') ? $request->file('notaris')->store('notaris') : null;
        $npwpPath = $request->file('npwp')->store('npwp');
        $domicileLetterPath = $request->file('domicile_letter')->store('letters');
        $tanahPath = $request->file('tanah')->store('tanah');
        $rabPath = $request->file('rab')->store('rab');

        $submission = new Submission([
            'nik' => $request->input('nik'),
            'name' => $request->input('name'),
            'bank_name' => $request->input('bank_name'),
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

        toast('Permintaan Berhasil Ditambahkan.','success');
        return redirect()->route('submissions.index');
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

    public function profilmasyarakat()
    {
        $user = Auth::user();
        $avatar = $user->avatar; // Mengambil avatar dari model pengguna
    
        return view('submissions.profil', compact('user', 'avatar'));
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
            default:
                abort(404);
        }

        if (!$file || !\Storage::exists($file)) {
            abort(404);
        }

        return response()->file(storage_path('app/' . $file));
    }
}
