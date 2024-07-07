<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
use Auth;
use App\Models\Submission;

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
}
