<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UpdateProfilController extends Controller
{
    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->nik = $request->input('nik');
        $user->name = $request->input('name');
        $user->save();

        toast('Bio Data Berhasil Disimpan','success');
        return redirect()->back();
    }
}
