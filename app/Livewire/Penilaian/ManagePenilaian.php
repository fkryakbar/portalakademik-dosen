<?php

namespace App\Livewire\Penilaian;

use App\Exports\TemplateNilaiExport;
use App\Imports\NilaiImport;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ManagePenilaian extends Component
{

    use WithFileUploads;


    #[Locked]
    public $kode_kelas;

    #[Validate('required|file|mimes:xlsx,xls|max:10240')]
    public $excel;

    public function save()
    {
        $this->dispatch('save-event');
        $this->dispatch('saved-alert');
    }

    public function refresh_now()
    {
        return redirect('/penilaian/' . $this->kode_kelas);
    }



    public function download_template()
    {
        $export =  new TemplateNilaiExport($this->kode_kelas);

        return Excel::download($export, 'Nilai - ' . $this->kode_kelas . '.xlsx');
    }

    public function submit_excel()
    {
        $this->validate();

        Excel::import(new NilaiImport($this->kode_kelas), $this->excel);
        $this->dispatch('saved-alert');
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
