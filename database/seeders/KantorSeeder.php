<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kantor;

class KantorSeeder extends Seeder
{
    public function run(): void
    {
        $kantors = config('jaringan_kantor.kantor');

        foreach ($kantors as $kantor) {
            if (!isset($kantor['id'])) {
                continue;
            }

            Kantor::updateOrCreate(
                ['id' => $kantor['id']],
                [
                    'nama'      => $kantor['nama'] ?? '-',
                    'alamat'    => $kantor['alamat'] ?? '-',
                    'latitude'  => $kantor['latitude'] ?? 0,
                    'longitude' => $kantor['longitude'] ?? 0,
                ]
            );
        }

    }
}
