<table style="border: none; font-size: 12px">
    <tr>
        <td style="border: none; padding: 3px">Tahun Ajaran</td>
        <td style="border: none; padding: 3px">: {{ $kelas->tahun_ajaran->nama_tahun_ajaran }}</td>
    </tr>
    <tr>
        <td style="border: none; padding: 3px">Kelas</td>
        <td style="border: none; padding: 3px">: {{ $kelas->nama }}</td>
    </tr>
    <tr>
        <td style="border: none; padding: 3px">Kode</td>
        <td style="border: none; padding: 3px">: {{ $kelas->mata_kuliah->kode }}</td>
    </tr>
    <tr>
        <td style="border: none; padding: 3px">Mata Kuliah</td>
        <td style="border: none; padding: 3px">: {{ $kelas->mata_kuliah->nama }}</td>
    </tr>
    <tr>
        <td style="border: none; padding: 3px">Semester</td>
        <td style="border: none; padding: 3px">: {{ $kelas->mata_kuliah->semester }}</td>
    </tr>
    <tr>
        <td style="border: none; padding: 3px">SKS</td>
        <td style="border: none; padding: 3px">: {{ $kelas->mata_kuliah->jumlah_sks }}</td>
    </tr>
</table>
<table width="100%" style="font-size: 10px; ; margin-top: 10px" class="table">
    <thead class="thead-light">
        <tr>
            <th style="text-align: center;border: 1px solid rgb(133, 133, 133);">No</th>
            <th style="text-align: center;border: 1px solid rgb(133, 133, 133);">NIM</th>
            <th style="text-align: center;border: 1px solid rgb(133, 133, 133);">Nama</th>
            <th style="text-align: center;border: 1px solid rgb(133, 133, 133);">Tugas</th>
            <th style="text-align: center;border: 1px solid rgb(133, 133, 133);">MT</th>
            <th style="text-align: center;border: 1px solid rgb(133, 133, 133);">FT</th>
        </tr>
    </thead>
    <tbody>
        @php
            $index = 1;
        @endphp
        @foreach ($mahasiswa as $i => $m)
            <tr>
                <td style="text-align: center;border: 1px solid rgb(133, 133, 133);">{{ $i + 1 }}</td>
                <td style="text-align: center;border: 1px solid rgb(133, 133, 133);">{{ $m->username }}</td>
                <td style="border: 1px solid rgb(133, 133, 133);">{{ $m->name }}</td>
                <td style="text-align: center;border: 1px solid rgb(133, 133, 133);">{{ $m->kartu_studi[0]->tugas }}
                </td>
                <td style="text-align: center;border: 1px solid rgb(133, 133, 133);">{{ $m->kartu_studi[0]->uts }}</td>
                <td style="text-align: center;border: 1px solid rgb(133, 133, 133);">{{ $m->kartu_studi[0]->uas }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
