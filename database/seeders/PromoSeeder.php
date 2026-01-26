<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Promo;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            /**
             * =====================================
             * DATA PROMO
             * =====================================
             */
            $promos = [
                [
                    'slug' => 'simbada',
                    'title' => 'SIMBADA',
                    'subtitle' => 'Tabungan SIMBADA BPR NTB',
                    'image' => 'images/simbada-card.png',
                    'short_desc' =>
                        'Simpanan berhadiah dengan peluang memenangkan undian menarik dan beragam hadiah spektakuler setiap periode.',
                    'description' =>
                        'Tabungan SIMBADA BPR NTB merupakan tabungan berjangka yang disediakan bagi Anda yang ingin mempersiapkan kebutuhan ibadah Qurban. Dengan mendaftarkan tabungan ini, Anda juga mendapatkan jaminan asuransi jiwa. Nilai setoran dapat disesuaikan dengan kemampuan dan kebutuhan Anda.',
                    'benefits' => [
                        'Bebas biaya administrasi bulanan',
                        'Suku bunga fix 4%',
                        'Biaya pembukaan rekening minimal Rp 15.000,-',
                        'Tidak perlu antre, cukup hubungi collector',
                        'Tanpa ATM untuk membantu disiplin menabung',
                        'Syarat mudah, hanya KTP',
                    ],
                    'requirements' => [
                        'Warga Negara Indonesia (WNI)',
                        'Mengisi Formulir Pembukaan Rekening',
                        'Identitas Diri (KTP/KIA) Aktif',
                        'Setoran Awal Sesuai Ketentuan',
                    ],
                ],

                [
                    'slug' => 'tabunganku',
                    'title' => 'TabunganKU',
                    'subtitle' => 'Tabungan KU BPR NTB',
                    'image' => 'images/tabunganku.png',
                    'short_desc' =>
                        'Tanpa biaya administrasi bulanan, setoran awal sangat ringan.',
                    'description' =>
                        'Tabungan KU BPR NTB merupakan tabungan yang dikhususkan untuk perorangan dengan persyaratan mudah dan ringan. Diterbitkan secara bersama oleh bank-bank di Indonesia serta bebas biaya administrasi.',
                    'benefits' => [
                        'Bebas biaya administrasi bulanan',
                        'Suku bunga fix 4%',
                        'Biaya pembukaan rekening minimal Rp 15.000,-',
                        'Tidak perlu antre, cukup hubungi collector',
                        'Tanpa ATM untuk membantu disiplin menabung',
                        'Syarat mudah, hanya KTP',
                    ],
                    'requirements' => [
                        'Warga Negara Indonesia (WNI)',
                        'Mengisi Formulir Pembukaan Rekening',
                        'Identitas Diri (KTP/KIA) Aktif',
                        'Setoran Awal Sesuai Ketentuan',
                    ],
                ],

                [
                    'slug' => 'tabungan-sukses',
                    'title' => 'Tabungan Sukses',
                    'subtitle' => 'Tabungan Sukses BPR NTB',
                    'image' => 'images/tabungan-sukses.png',
                    'short_desc' =>
                        'Investasi aman dengan suku bunga kompetitif untuk rencana Anda.',
                    'description' =>
                        'Tabungan Sukses BPR NTB merupakan produk tabungan yang ditujukan bagi pelaku usaha kecil dan masyarakat yang ingin mengelola keuangan dengan lebih baik. Produk ini menawarkan suku bunga bersaing dan biaya administrasi sangat rendah. Setoran awal ringan dan dapat dilakukan melalui staf collector kami.',
                    'benefits' => [
                        'Biaya administrasi sangat rendah, mulai Rp 1.000,-',
                        'Suku bunga menarik hingga 5%',
                        'Biaya pembukaan rekening minimal Rp 20.000,-',
                        'Tidak perlu antre, cukup hubungi collector kami',
                        'Disediakan buku tabungan manual',
                        'Tanpa ATM untuk membantu disiplin menabung',
                        'Persyaratan sangat mudah, hanya KTP',
                    ],
                    'requirements' => [
                        'Warga Negara Indonesia (WNI)',
                        'Mengisi Formulir Pembukaan Rekening',
                        'Identitas Diri (KTP/KIA) Aktif',
                        'Setoran Awal Sesuai Ketentuan',
                    ],
                ],
            ];

            /**
             * =====================================
             * INSERT / UPDATE PROMO
             * =====================================
             */
            foreach ($promos as $data) {
                $promo = Promo::updateOrCreate(
                    ['slug' => $data['slug']],
                    [
                        'title'       => $data['title'],
                        'subtitle'    => $data['subtitle'],
                        'image'       => $data['image'],
                        'short_desc'  => $data['short_desc'],
                        'description' => $data['description'],
                        'is_active'   => true,
                    ]
                );

                // reset detail
                DB::table('promo_benefits')->where('promo_id', $promo->id)->delete();
                DB::table('promo_requirements')->where('promo_id', $promo->id)->delete();

                foreach ($data['benefits'] as $benefit) {
                    DB::table('promo_benefits')->insert([
                        'promo_id' => $promo->id,
                        'title' => $benefit,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                foreach ($data['requirements'] as $req) {
                    DB::table('promo_requirements')->insert([
                        'promo_id' => $promo->id,
                        'title' => $req,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });
    }
}
