<tr>
    <th>{{ $index + 1 }}</th>
    <td>{{ $mahasiswa->username }}</td>
    <td> {{ $mahasiswa->name }}</td>
    <td>
        <div class="flex justify-center">
            @if ($kelas->is_validated == 1)
                {{ $tugas }}
            @else
                <input type="text" wire:model='tugas' class="input input-bordered w-[60px]" />
            @endif
        </div>
        @error('tugas')
            <p class="text-xs text-red-500">
                {{ $message }}
            </p>
        @enderror
    </td>
    <td>
        <div class="flex justify-center">
            @if ($kelas->is_validated == 1)
                {{ $uts }}
            @else
                <input type="text" wire:model='uts' class="input input-bordered w-[60px]" />
            @endif
        </div>
        @error('uts')
            <p class="text-xs text-red-500">
                {{ $message }}
            </p>
        @enderror
    </td>
    <td>
        <div class="flex justify-center">
            @if ($kelas->is_validated == 1)
                {{ $uas }}
            @else
                <input type="text" wire:model='uas' class="input input-bordered w-[60px]" />
            @endif
        </div>
        @error('uas')
            <p class="text-xs text-red-500">
                {{ $message }}
            </p>
        @enderror
    </td>
    <td> {{ $angka }}</td>
    <td> {{ $bobot }}</td>
    <td> {{ $huruf }}</td>
</tr>
