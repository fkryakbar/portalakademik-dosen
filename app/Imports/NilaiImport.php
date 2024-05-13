<?php

namespace App\Imports;

use App\Models\KartuStudi;
use App\Models\Kelas;
use App\Models\User;
use App\Traits\KonversiNilai;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NilaiImport implements ToModel, WithHeadingRow
{
    use KonversiNilai;

    protected $kode_kelas;

    public function __construct($kode_kelas)
    {
        $this->kode_kelas = $kode_kelas;
    }

    public function model(array $row)
    {

        $kelas = Kelas::where('kode_kelas', $this->kode_kelas)->whereHas('dosen', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->with('dosen', 'mata_kuliah')->firstOrFail();

        $mahasiswa = User::where('role', 'mahasiswa')->where('username', $row['nim'])->whereHas('kelas', function ($query) {
            $query->where('kode_kelas', $this->kode_kelas);
        })->whereHas('kartu_studi', function ($query) use ($kelas) {
            $query->where('kode_mata_kuliah', $kelas->mata_kuliah->kode);
        })->with(['kartu_studi' => function ($query) use ($kelas) {
            $query->where('kode_mata_kuliah', $kelas->mata_kuliah->kode);
        }, 'kelas'])->first();
        if ($mahasiswa) {
            $nilai = $this->konversi_nilai($row['tugas'], $row['mt'], $row['ft'], $mahasiswa->kartu_studi[0]->mata_kuliah->jumlah_sks);
            $kartu_studi = KartuStudi::where('id', $mahasiswa->kartu_studi[0]->id)->first();

            if (!isset($row['tugas']) && !isset($row['mt']) && !isset($row['ft'])) {
                $kartu_studi->update([
                    'tugas' => null,
                    'uts' => null,
                    'uas' => null,
                    'angka' => null,
                    'bobot' => null,
                    'huruf' => null,
                ]);
            } else {
                $kartu_studi->update([
                    'tugas' => $nilai->tugas,
                    'uts' => $nilai->uts,
                    'uas' => $nilai->uas,
                    'angka' => $nilai->angka,
                    'bobot' => $nilai->bobot,
                    'huruf' => $nilai->huruf,
                ]);
            }
        }
    }

    public function headingRow(): int
    {
        return 8;
    }
}
