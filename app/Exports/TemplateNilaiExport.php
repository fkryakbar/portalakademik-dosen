<?php

namespace App\Exports;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TemplateNilaiExport implements FromView, WithColumnFormatting, ShouldAutoSize
{

    protected $kode_kelas;

    public function __construct($kode_kelas)
    {
        $this->kode_kelas = $kode_kelas;
    }

    public function view(): View
    {

        $kelas = Kelas::where('kode_kelas', $this->kode_kelas)->whereHas('dosen', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->with('dosen', 'mata_kuliah')->firstOrFail();

        $mahasiswa = User::where('role', 'mahasiswa')->whereHas('kelas', function ($query) {
            $query->where('kode_kelas', $this->kode_kelas);
        })->whereHas('kartu_studi', function ($query) use ($kelas) {
            $query->where('kode_mata_kuliah', $kelas->mata_kuliah->kode);
        })->with(['kartu_studi' => function ($query) use ($kelas) {
            $query->where('kode_mata_kuliah', $kelas->mata_kuliah->kode);
        }, 'kelas'])->orderBy('username', 'asc')->get();

        return view('cetak.export-nilai', compact('kelas', 'mahasiswa'));
    }


    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
            'D' => NumberFormat::FORMAT_NUMBER,
            'E' => NumberFormat::FORMAT_NUMBER,
            'F' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
