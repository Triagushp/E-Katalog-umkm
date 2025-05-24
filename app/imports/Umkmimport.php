<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Umkm;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class UmkmImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Lewati baris header

            $user = User::create([
                'name' => $row[0],
                'email' => $row[5],
                'password' => Hash::make('default123'),
                'role' => 'umkm',
            ]);

            Umkm::create([
                'user_id' => $user->id,
                'nama_umkm' => $row[0],
                'alamat' => $row[1],
                'no_wa' => $row[2],
                'instagram' => $row[3],
                'nama_pemilik' => $row[4],
            ]);
        }
    }
}
