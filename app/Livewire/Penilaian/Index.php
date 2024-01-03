<?php

namespace App\Livewire\Penilaian;

use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
    public $search = '';

    #[Layout('layouts.main')]
    public function render()
    {
        $kelas = Kelas::latest()->wherehas('dosen', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->where('is_visible', 1)->with('tahun_ajaran')->get()->groupBy('tahun_ajaran.nama_tahun_ajaran');

        $search = $this->search;
        if (Str::length($this->search) >= 3) {
            $kelas = Kelas::where(function (Builder $query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('kode_mata_kuliah', 'like', '%' . $search . '%');
            })->latest()->wherehas('dosen', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->where('is_visible', 1)->with('tahun_ajaran')->get()->groupBy('tahun_ajaran.nama_tahun_ajaran');
        }
        return view('penilaian.index', [
            'kelas' => $kelas
        ]);
    }
}
