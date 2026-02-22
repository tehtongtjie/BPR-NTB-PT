<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Umkm;
use App\Models\UmkmImage;
use App\Models\UmkmProduct;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | UMKM 1 - Pawon Pengsong
        |--------------------------------------------------------------------------
        */
        $pawon = Umkm::create([
            'slug'           => 'pawon-pengsong',
            'nama_usaha'     => 'Pawon Pengsong',
            'nama_pemilik'   => 'Ibu Nur Aida',
            'bidang_usaha'   => 'Makanan & Minuman',
            'lokasi'         => 'Lombok Barat, NTB',
            'telepon'        => '082359191086',
            'deskripsi'      => 'Produsen skala besar produk olahan lokal dengan standar kualitas internasional. Menghadirkan kehangatan Serbat Jahe, Kopi Rempah khas Lombok, serta camilan sehat Biskuit Kelor dan Rumput Laut.',
            'unggulan'       => 'Serbat, Biskuit Kelor, dan Kopi Jahe',
            'skala'          => 'Internasional',
        ]);

        // Thumbnail
        UmkmImage::create([
            'umkm_id'      => $pawon->id,
            'image_path'   => 'images/umkm/pawon/pawon-1.png',
            'is_thumbnail' => true,
        ]);

        // Galeri
        $pawonGallery = [
            'images/umkm/pawon/pawon-2.png',
            'images/umkm/pawon/pawon-3.png',
            'images/umkm/pawon/pawon-4.png',
            'images/umkm/pawon/pawon-5.png',
        ];

        foreach ($pawonGallery as $image) {
            UmkmImage::create([
                'umkm_id'      => $pawon->id,
                'image_path'   => $image,
                'is_thumbnail' => false,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | UMKM 2 - Waroh Maju Bersama
        |--------------------------------------------------------------------------
        */
        $waroh = Umkm::create([
            'slug'           => 'waroh-maju-bersama',
            'nama_usaha'     => 'Waroh Maju Bersama',
            'nama_pemilik'   => 'Mainah',
            'bidang_usaha'   => 'Makanan & Minuman',
            'lokasi'         => 'Narmada, Lombok Barat',
            'telepon'        => '081805720941',
            'link_instagram' => 'https://instagram.com/Warohmb005',
            'deskripsi'      => 'Merupakan salah satu produsen oleh-oleh khas lombok yang menyediakan berbagai macam makanan olahan yang terbuat dari rumput laut, singkong, pisang, ubi jalar dan talas. Semua diolah secara profesional dengan bumbu rempah-rempah tradisional sehingga menciptakan rasa yang berbeda dengan makanan olahan lainnya.',
            'unggulan'       => 'Ceker Rumput Laut, Keripik Pisang, dan Keripik Pare',
            'skala'          => 'Lokal',
            'alamat'         => 'Jln. Suranadi II dusun Penangkep desa sesaot kec. Narmada, Lombok Barat',
        ]);

        // Thumbnail
        UmkmImage::create([
            'umkm_id'      => $waroh->id,
            'image_path'   => 'images/umkm/waroh/waroh-1.png',
            'is_thumbnail' => true,
        ]);

        // Galeri
        $warohGallery = [
            'images/umkm/waroh/waroh-2.png',
            'images/umkm/waroh/waroh-3.png',
            'images/umkm/waroh/waroh-4.png',
            'images/umkm/waroh/waroh-5.png',
            'images/umkm/waroh/waroh-6.png',
        ];

        foreach ($warohGallery as $image) {
            UmkmImage::create([
                'umkm_id'      => $waroh->id,
                'image_path'   => $image,
                'is_thumbnail' => false,
            ]);
        }

        // Produk List
        $warohProducts = [
            'Keripik Pisang',
            'Keripik Talas',
            'Keripik Singkong',
            'Keripik Ubi Ungu',
            'Keripik Ubi Madu',
            'Keripik Rumput Laut',
            'Rengginang Singkong',
            'Manisan Tomat',
            'Manisan Rumput Laut',
            'Dodol Nangka',
            'Dodol Pisang',
            'Sale Pisang',
            'Kerupuk Rumput Laut',
            'Kopi',
            'Keripik Pare',
        ];

        foreach ($warohProducts as $produk) {
            UmkmProduct::create([
                'umkm_id'     => $waroh->id,
                'nama_produk' => $produk,
            ]);
        }
    }
}
