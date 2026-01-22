<?php

return [

    /*
    |--------------------------------------------------------------------------
    | DEPOSITO BERJANGKA
    |--------------------------------------------------------------------------
    */
    'deposito-berjangka' => [
        'nama' => 'DEPOSITO BERJANGKA',
        'subtitle' => 'Deposito Berjangka BPR NTB',
        'deskripsi' => 'Deposito Berjangka BPR NTB merupakan produk simpanan
                        dengan jangka waktu tertentu dan suku bunga kompetitif.
                        Cocok bagi nasabah yang menginginkan investasi aman
                        dengan hasil pasti dan dijamin LPS.',

        'gambar' => 'images\deposito\deposito-bejangka.png',

        /*
        | Suku bunga per tahun (setelah pajak)
        | Jangka waktu dalam bulan
        */
        'suku_bunga' => [
            1  => '5.00%',
            3  => '5.25%',
            6  => '5.50%',
            12 => '6.00%',
        ],

        /*
        | Minimal setoran deposito
        */
        'minimal_deposito' => 5000000,

        /*
        | Contoh perolehan bunga per bulan (setelah pajak)
        | Format: nominal => [1 bulan, 3 bulan, 6 bulan, 12 bulan]
        */
        'simulasi_bunga' => [
            5000000 => [
                1  => 20833,
                3  => 21875,
                6  => 22917,
                12 => 25000,
            ],
            10000000 => [
                1  => 33333,
                3  => 35000,
                6  => 36667,
                12 => 40000,
            ],
            25000000 => [
                1  => 83333,
                3  => 87500,
                6  => 91667,
                12 => 100000,
            ],
            50000000 => [
                1  => 166667,
                3  => 175000,
                6  => 183333,
                12 => 200000,
            ],
            100000000 => [
                1  => 333333,
                3  => 350000,
                6  => 366667,
                12 => 400000,
            ],
            500000000 => [
                1  => 1666667,
                3  => 1750000,
                6  => 1833333,
                12 => 2000000,
            ],
            1000000000 => [
                1  => 3333333,
                3  => 3500000,
                6  => 3666667,
                12 => 4000000,
            ],
            2000000000 => [
                1  => 6666667,
                3  => 7000000,
                6  => 7333333,
                12 => 8000000,
            ],
        ],

        /*
        | Keuntungan Deposito
        */
        'keuntungan' => [
            'Suku bunga kompetitif hingga 6,00% per tahun (setelah pajak)',
            'Pilihan jangka waktu fleksibel (1, 3, 6, dan 12 bulan)',
            'Minimal penempatan Rp 5.000.000',
            'Bunga telah diperhitungkan pajak',
            'Dana dijamin oleh LPS sesuai ketentuan',
            'Aman dan terpercaya, diawasi oleh OJK',
        ],

        /*
        | Persyaratan Deposito
        */
        'persyaratan' => [
            'perorangan' => [
                'Fotokopi E-KTP',
                'Fotokopi Kartu Keluarga (KK)',
            ],
            'badan_usaha' => [
                'Fotokopi Akta Pendirian',
                'Fotokopi Akta Perubahan Terakhir',
                'Fotokopi E-KTP Direksi / Pengurus',
                'Fotokopi NPWP Perusahaan',
            ],
        ],

        /*
        | Catatan Penting
        */
        'catatan' => [
            'Suku bunga dapat berubah sewaktu-waktu sesuai ketentuan LPS',
            'PT BPR NTB PERSERODA berizin dan diawasi oleh OJK',
            'Merupakan peserta penjaminan LPS',
        ],
    ],

];
