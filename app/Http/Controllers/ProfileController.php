<?php

namespace App\Http\Controllers;

use App\Models\BiodataDosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    private function get_file_name($name)
    {
        $array = explode('/', $name);
        return  $array[1];
    }

    public function index()
    {
        $dosen = User::where('role', 'dosen')->where('id', Auth::user()->id)->firstOrFail();
        return view('profile.index', [
            'dosen' => $dosen
        ]);
    }

    public function update(Request $request)
    {
        $dosen = User::where('role', 'dosen')->where('username', Auth::user()->username)->firstOrFail();

        $request->validate([
            'name' => 'required|max:100',

            'profile' => 'file|mimes:jpeg,png|max:100',
            'nik' => 'max:100',
            'email' => 'max:100',
            'no_telp' => 'max:30',
            'jenis_kelamin' => 'max:20',
            'tempat_lahir' => 'max:50',
            'tanggal_lahir' => 'max:15',
            'alamat' => 'max:300',
            'pendidikan_terakhir' => 'max:50',
            'progam_studi' => 'max:40'

        ]);

        $dosen->update($request->only(['name']));

        $biodata = BiodataDosen::where('user_id', $dosen->id)->firstOrFail();

        if ($request->file('profile')) {
            if ($dosen->biodata->gambar) {
                Storage::delete($dosen->biodata->gambar);
                $path =  $request->file('profile')->store('/profile');
            } else {
                $path =  $request->file('profile')->store('/profile');
            }
            $request->merge(['gambar' => $path]);
        }

        $biodata->update($request->except(['profile', 'name', 'username', 'is_reset_password']));

        return back()->with('message', 'Biodata berhasil disimpan');
    }
}
