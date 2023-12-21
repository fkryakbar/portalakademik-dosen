<?php

namespace App\Livewire\Penilaian;

use App\Models\KartuStudi;
use App\Traits\KonversiNilai;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class InputNilai extends Component
{
    use KonversiNilai;
    public $mahasiswa;
    public $kelas;
    public $index;

    public $id;

    #[Validate('numeric|min:0|max:100')]
    public $tugas;

    #[Validate('numeric|min:0|max:100')]
    public $uts;

    #[Validate('numeric|min:0|max:100')]
    public $uas;

    public $angka;
    public $bobot;
    public $huruf;

    #[On('save-event')]
    public function save()
    {
        $kartu_studi = KartuStudi::where('id', '=', $this->id)->with('mata_kuliah')->firstOrFail();
        $this->validate();
        if ($this->tugas && $this->uts && $this->uas) {
            $nilai = $this->konversi_nilai($this->tugas, $this->uts, $this->uas, $kartu_studi->mata_kuliah->jumlah_sks);

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


    public function mount()
    {
        $this->id = $this->mahasiswa->kartu_studi[0]->id;
        $this->tugas = $this->mahasiswa->kartu_studi[0]->tugas;
        $this->uts = $this->mahasiswa->kartu_studi[0]->uts;
        $this->uas = $this->mahasiswa->kartu_studi[0]->uas;
        $this->angka = $this->mahasiswa->kartu_studi[0]->angka;
        $this->bobot = $this->mahasiswa->kartu_studi[0]->bobot;
        $this->huruf = $this->mahasiswa->kartu_studi[0]->huruf;
    }

    public function render()
    {
        return view('penilaian.input-nilai');
    }
}
