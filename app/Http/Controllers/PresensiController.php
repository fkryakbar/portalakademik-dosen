<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function index()
    {
        $tahun_ajaran = TahunAjaran::latest()->limit(14)->get();
        return view('presensi.index', [
            'tahun_ajaran' => $tahun_ajaran
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required|max:50',
            'aktivitas' => 'required|max:500',
            'jumlah_mahasiswa' => 'required|numeric|max:300',
            'mahasiswa_tidak_hadir' => 'required|numeric|max:300',
            'detail_mahasiswa_tidak_hadir' => 'max:500',

            'tanggal' => 'required|max:30',
            'dari_jam' => 'required|max:10',
            'sampai_jam' => 'required|max:10',

            'foto_perkuliahan' => 'required|file|mimes:jpeg,png|max:500',
        ]);
        $tahun_ajaran = TahunAjaran::latest()->first();

        $waktu_perkuliahan = $request->tanggal . ' ' . $request->dari_jam . '-' . $request->sampai_jam;

        $path = $request->file('foto_perkuliahan')->store('/presensi_dosen');
        $request->merge([
            'waktu_perkuliahan' => $waktu_perkuliahan,
            'image_path' => $path,
            'user_id' => Auth::user()->id,
            'kode_tahun_ajaran' => $tahun_ajaran->kode_tahun_ajaran,
            'kode_pertemuan' => time()
        ]);

        Presensi::create($request->except(['tanggal', 'dari_jam', 'sampai_jam', 'foto_perkuliahan']));
        return back()->with('message', 'Presensi berhasil di upload');
    }

    public function view($kode_pertemuan)
    {
        $presensi = Presensi::where('kode_pertemuan', $kode_pertemuan)->where('user_id', Auth::user()->id)->firstOrFail();
        return view('presensi.view', [
            'presensi' => $presensi
        ]);
    }

    public function api_get_data($kode_tahun_ajaran)
    {
        $presensi = Presensi::where('user_id', Auth::user()->id)->where('kode_tahun_ajaran', $kode_tahun_ajaran)->latest()->get();
        return response([
            'message' => 'success',
            'data' => $presensi
        ]);
    }
}
