<?php

namespace App\Livewire\Penilaian;

use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public $counter = 0;

    public function increment()
    {
        $this->counter++;
    }

    #[Layout('layouts.main')]
    public function render()
    {
        $kelas = Kelas::latest()->wherehas('dosen', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->where('is_visible', 1)->with('tahun_ajaran')->get()->groupBy('tahun_ajaran.nama_tahun_ajaran');
        // dd($kelas);
        return view('penilaian.index', [
            'kelas' => $kelas
        ]);
    }
}
