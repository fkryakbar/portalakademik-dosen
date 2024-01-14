<?php

namespace App\Livewire\Penilaian;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ManagePenilaian extends Component
{
    #[Locked]
    public $kode_kelas;

    public function save()
    {
        $this->dispatch('save-event');
        $this->dispatch('saved-alert');
    }

    public function refresh_now()
    {
        return redirect('/penilaian/' . $this->kode_kelas);
    }


    #[Layout('layouts.main')]
    public function render()
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

        return view('penilaian.manage-penilaian', [
            'kelas' => $kelas,
            'mahasiswa' => $mahasiswa
        ]);
    }
}
