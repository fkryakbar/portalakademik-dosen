<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Presensi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function index()
    {
        $tahun_ajaran = TahunAjaran::latest()->first();
        $mata_kuliah = MataKuliah::latest()->get();
        $presensi = Presensi::where('user_id', Auth::user()->id)->where('kode_tahun_ajaran', $tahun_ajaran->kode_tahun_ajaran)->latest()->paginate();
        return view('presensi.index', [
            'tahun_ajaran' => $tahun_ajaran,
            'mata_kuliah' => $mata_kuliah,
            'presensi' => $presensi
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
            'jumlah_sks' => 'required|numeric|max:10',

            'tanggal' => 'required|max:30',
            'dari_jam' => 'required|max:10',
            'sampai_jam' => 'required|max:10',

            'foto_perkuliahan' => 'required|file|mimes:jpeg,png|max:4096',
        ], [
            'mata_kuliah.required' => 'Mata Kuliah wajib diisi',
            'aktivitas.required' => 'Aktivitas wajib diisi',
            'jumlah_mahasiswa.required' => 'Jumlah Mahasiswa wajib diisi',
            'mahasiswa_tidak_hadir.required' => 'Jumlah Mahasiswa tidak hadir wajib diisi',
            'detail_mahasiswa_tidak_hadir.required' => 'Detail Mahasiswa tidak hadir wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
            'dari_jam.required' => 'Dari Jam wajib diisi',
            'sampai_jam.required' => 'Sampai Jam wajib diisi',
            'foto_perkuliahan.required' => 'Foto Perkuliahan wajib diupload',
            'foto_perkuliahan.mimes' => 'Foto Perkuliahan wajib berupa file foto format JPEG atau PNG',
            'foto_perkuliahan.max' => 'Foto Perkuliahan Maksimal 4 MB',
            'jumlah_sks.required' => 'Jumlah SKS Wajib diisi'
        ]);
        $tahun_ajaran = TahunAjaran::latest()->first();

        $waktu_perkuliahan = $request->tanggal . ' ' . $request->dari_jam . '-' . $request->sampai_jam;

        $path = $request->file('foto_perkuliahan')->store('/presensi_dosen');
        $request->merge([
            'waktu_perkuliahan' => $waktu_perkuliahan,
            'image_path' => $path,
            'user_id' => Auth::user()->id,
            'kode_tahun_ajaran' => $tahun_ajaran->kode_tahun_ajaran,
            'kode_pertemuan' => time(),
            'time_to_edit' => time() + 3600
        ]);

        Presensi::create($request->except(['tanggal', 'dari_jam', 'sampai_jam', 'foto_perkuliahan']));
        return back()->with('message', 'Presensi berhasil di upload');
    }

    public function view($kode_pertemuan)
    {
        $presensi = Presensi::where('kode_pertemuan', $kode_pertemuan)->where('user_id', Auth::user()->id)->firstOrFail();
        $mata_kuliah = MataKuliah::latest()->get();
        return view('presensi.view', [
            'presensi' => $presensi,
            'mata_kuliah' => $mata_kuliah
        ]);
    }
    public function delete($kode_pertemuan)
    {
        $presensi = Presensi::where('kode_pertemuan', $kode_pertemuan)->where('user_id', Auth::user()->id)->where('time_to_edit', '>', time())->firstOrFail();
        Storage::delete($presensi->image_path);
        $presensi->delete();
        return back()->with('message', 'Data Berhasil dihapus');
    }
    public function api_get_data($kode_tahun_ajaran)
    {
        $presensi = Presensi::where('user_id', Auth::user()->id)->where('kode_tahun_ajaran', $kode_tahun_ajaran)->latest()->get();
        return response([
            'message' => 'success',
            'data' => $presensi
        ]);
    }

    public function update($kode_pertemuan, Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required|max:50',
            'aktivitas' => 'required|max:500',
            'jumlah_mahasiswa' => 'required|numeric|max:300',
            'mahasiswa_tidak_hadir' => 'required|numeric|max:300',
            'detail_mahasiswa_tidak_hadir' => 'max:500',
            'jumlah_sks' => 'required|numeric|max:10',

            'tanggal' => 'required|max:30',
            'dari_jam' => 'required|max:10',
            'sampai_jam' => 'required|max:10',

            'foto_perkuliahan' => 'file|mimes:jpeg,png|max:4096',
        ], [
            'mata_kuliah.required' => 'Mata Kuliah wajib diisi',
            'aktivitas.required' => 'Aktivitas wajib diisi',
            'jumlah_mahasiswa.required' => 'Jumlah Mahasiswa wajib diisi',
            'mahasiswa_tidak_hadir.required' => 'Jumlah Mahasiswa tidak hadir wajib diisi',
            'detail_mahasiswa_tidak_hadir.required' => 'Detail Mahasiswa tidak hadir wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
            'dari_jam.required' => 'Dari Jam wajib diisi',
            'sampai_jam.required' => 'Sampai Jam wajib diisi',
            'foto_perkuliahan.required' => 'Foto Perkuliahan wajib diupload',
            'foto_perkuliahan.mimes' => 'Foto Perkuliahan wajib berupa file foto format JPEG atau PNG',
            'foto_perkuliahan.max' => 'Foto Perkuliahan Maksimal 4 MB',
            'jumlah_sks.required' => 'Jumlah SKS Wajib diisi'
        ]);
        $presensi = Presensi::where('kode_pertemuan', $kode_pertemuan)->where('user_id', Auth::user()->id)->where('time_to_edit', '>', time())->firstOrFail();

        $waktu_perkuliahan = $request->tanggal . ' ' . $request->dari_jam . '-' . $request->sampai_jam;
        $request->merge([
            'waktu_perkuliahan' => $waktu_perkuliahan
        ]);

        if ($request->foto_perkuliahan) {
            $request->file('foto_perkuliahan')->storeAs('/', $presensi->image_path);
        }

        $presensi->update($request->except(['foto_perkuliahan', 'tanggal', 'dari_jam', 'sampai_jam']));
        return back()->with('message', 'Data berhasil diperbarui');
    }
}
