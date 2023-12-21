<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function cetak($kode_kelas)
    {
        $kelas = Kelas::where('kode_kelas', $kode_kelas)->whereHas('dosen', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->with('dosen', 'mata_kuliah', 'tahun_ajaran')->firstOrFail();

        $mahasiswa = User::where('role', 'mahasiswa')->whereHas('kelas', function ($query) use ($kode_kelas) {
            $query->where('kode_kelas', $kode_kelas);
        })->whereHas('kartu_studi', function ($query) use ($kelas) {
            $query->where('kode_mata_kuliah', $kelas->mata_kuliah->kode);
        })->with('kartu_studi', 'kelas')->get();

        $tanggal =  Carbon::today()->translatedFormat('d F Y');
        $pdf = Pdf::loadView('cetak.rekap-nilai', compact('tanggal', 'kelas', 'mahasiswa'));
        // return view('cetak.rekap-nilai', compact('tanggal', 'kelas', 'mahasiswa'));
        return $pdf->stream('Rekap nilai.pdf');
    }
}
