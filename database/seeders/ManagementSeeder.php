<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManagementSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            // =========================
            // KOMISARIS
            // =========================
            [
                'name' => 'Ria Prayuniarti, SP',
                'slug' => 'ria-prayuniarti',
                'type' => 'komisaris',
                'position' => 'Komisaris Independen',
                'image' => 'images/perusahaan/ria-prayuniarti.png',
                'excerpt' => 'Komisaris Independen dengan pengalaman panjang di sektor perbankan.',
                'profile' => <<<TEXT
Ria Prayuniarti merupakan lulusan S1 Sarjana Pertanian Universitas Mataram pada tahun 1995. Mengawali kariernya di LKP Mujur pada tahun 1997–1998 sebagai staf administrasi. Selanjutnya, pada tahun 1998–2006 beliau berkarier di PD BPR LKP Mujur dan secara periodik menduduki jabatan Kepala Bagian Pembukuan, Kepala Bagian Umum, dan Kepala Bagian Kredit.

Pada tahun 2006–2009, beliau diangkat menjadi Direktur PD BPR LKP Pringgarata. Saat konsolidasi PD BPR LKP di wilayah Kabupaten Lombok Tengah menjadi PD BPR NTB Lombok Tengah pada tahun 2009–2014, beliau dipercaya sebagai Kepala Divisi Pengawasan. Kemudian pada tahun 2014–2019, beliau menjabat sebagai Direktur PD BPR NTB Lombok Tengah dan pada tahun 2019–2022 diangkat menjadi Direktur Utama. Sejak tahun 2022 hingga saat ini, beliau menjabat sebagai Komisaris Independen di PT BPR NTB.

Berbekal pengalaman panjang di sektor perbankan, beliau memiliki keahlian dalam Akuntansi Perbankan, Tata Kelola Perusahaan, Pengawasan Bank, Manajemen Risiko, Manajemen Keuangan, Pengelolaan SDM, serta Pemasaran Produk Kredit dan Simpanan. Untuk menunjang kompetensinya, beliau telah mengikuti berbagai pelatihan, antara lain Pelatihan Manajemen Risiko, Penyusunan SOP, Pelatihan Satuan Pengawas Internal, Pelatihan Metode Audit Investigasi, Penyusunan Rencana Bisnis BPR, Penerapan Tata Kelola BPR, Service Excellent, dan lainnya. Beliau juga aktif mengikuti sosialisasi ketentuan Bank Indonesia dan OJK serta memegang sertifikasi Direktur BPR dan Komisaris BPR.

Atas dedikasi dan kontribusinya, saat menjabat sebagai Direksi PD BPR NTB Lombok Tengah, beliau pernah meraih penghargaan dari Pemerintah Provinsi Nusa Tenggara Barat sebagai salah satu dari 3 besar BPR dengan kontribusi PAD melalui dividen tertinggi di antara 8 PD BPR NTB se-NTB. Sepanjang perjalanan kariernya, beliau berhasil menerapkan tata kelola perusahaan yang baik, manajemen keuangan yang sehat, mitigasi risiko yang komprehensif, serta pengembangan usaha dan peningkatan profit di setiap BPR tempat beliau berkarya.
TEXT
            ],

            [
                'name' => 'Syarif Mustaan, SE., M.Si',
                'slug' => 'syarif-mustaan',
                'type' => 'komisaris',
                'position' => 'Komisaris Independen',
                'image' => 'images/perusahaan/syarif-mustaan.png',
                'excerpt' => 'Komisaris Independen dengan latar belakang ekonomi dan pengawasan BPR.',
                'profile' => <<<TEXT
Syarif Mustaan merupakan lulusan S1 Sarjana Ekonomi dari Universitas Muhammadiyah Malang pada tahun 1991. Beliau juga telah menyelesaikan pendidikan Pascasarjana di Universitas Samawa (UNSA) NTB pada Program Studi Agro Bisnis dan meraih gelar Magister Sains (M.Si) pada tahun 2025.

Mengawali karier profesionalnya di PT Insan Mandiri Jakarta pada tahun 2000–2003 sebagai Micro Finance Specialist. Selanjutnya, beliau berkiprah sebagai konsultan pemberdayaan masyarakat di berbagai lembaga, antara lain GTZ ProFi, LSM Mandiri, PT KOGAS DRIYAP, dan Direktorat Jenderal Departemen Dalam Negeri RI pada periode 2007–2013.

Pada tahun 2007–2016, beliau menjadi konsultan Lembaga Keuangan Mikro (LKM) pada Pemerintah Daerah Kabupaten Sumbawa. Sejak 2005–2017, beliau juga menjabat sebagai Anggota Dewan Pengawas di PD BPR NTB Sumbawa dan PD BPR NTB Sumbawa Barat. Kemudian pada tahun 2018–2021, beliau dipercaya menjadi Ketua Dewan Pengawas di kedua BPR tersebut. Sejak tahun 2022 hingga saat ini, beliau menjabat sebagai Komisaris Independen di PT BPR NTB Perseroda.

Beliau memiliki keahlian dalam Akuntansi Perbankan, Tata Kelola Perusahaan, Pengawasan Bank, Manajemen Risiko, Manajemen Keuangan, Pengelolaan SDM, serta Pemasaran Produk Kredit dan Simpanan. Selain itu, beliau juga berkompetensi sebagai konsultan LKM dan pemberdayaan masyarakat. Dalam rangka pengembangan profesional, beliau telah mengikuti berbagai pelatihan, termasuk Manajemen Risiko, Penyusunan SOP, Audit Investigasi, Penyusunan Rencana Bisnis BPR, Tata Kelola BPR, Service Excellent, hingga pelatihan pengawasan eksternal LKM.

Syarif Mustaan aktif di Perbarindo sejak tahun 2015 dan pernah menjabat di beberapa posisi strategis. Atas dedikasi dan kontribusinya, PD BPR NTB Sumbawa berhasil meraih penghargaan dari Pemerintah Provinsi Nusa Tenggara Barat sebagai salah satu dari 3 besar BPR dengan kontribusi PAD melalui dividen tertinggi di antara 8 PD BPR NTB se-NTB. Sepanjang kariernya, beliau konsisten menerapkan tata kelola yang baik, menjaga manajemen keuangan yang sehat, serta mendorong pengembangan usaha dan peningkatan profit di setiap BPR tempat beliau berkarya.
TEXT
            ],

            // =========================
            // DIREKSI
            // =========================
            [
                'name' => 'Hj. Denda Sucihartiani, SE',
                'slug' => 'denda-sucihartiani',
                'type' => 'direksi',
                'position' => 'Direktur Bisnis',
                'image' => 'images/perusahaan/denda-sucihartiani.png',
                'excerpt' => 'Direktur Bisnis dengan pengalaman panjang di sektor perbankan BPR.',
                'profile' => <<<TEXT
Hj. Denda Sucihartiani merupakan lulusan S1 Ekonomi Pembangunan Universitas Al-Azhar Mataram. Beliau mengawali karier perbankannya di PD. BPR NTB sejak tahun 1987 dan telah mengabdikan diri selama kurang lebih 35 tahun di dunia perbankan.

Sepanjang perjalanan kariernya, beliau pernah menduduki berbagai posisi strategis, antara lain sebagai Kepala pada PD. BPR LKP Gunung Sari (1987–1996), Direktur pada PD. BPR LKP Gunung Sari dan PD. BPR NTB Lombok Barat (1996–2010 dan 2010–2018), serta menjabat sebagai Direktur Utama di PD. BPR NTB Lombok Barat.

Selain pengalaman praktis di bidang perbankan, beliau juga aktif mengembangkan kompetensi diri melalui berbagai pelatihan, antara lain Pelatihan Analisa Pembiayaan, Manajemen Risiko dan Credit Scoring, Pelatihan APU & PPT, Strategi Penanganan Kredit Macet melalui Legal Formal dan Dasar-Dasar Negosiasi Pengagihan Kredit Macet, serta Pelatihan Service Excellent.

Hingga saat ini, beliau telah mengantongi Sertifikat Direktur Tingkat 1 BPR yang dikeluarkan oleh Lembaga Sertifikasi Profesi Bidang BPR, BPRS, dan LKM.
TEXT
            ],

            [
                'name' => 'Zulkifli Hamdani',
                'slug' => 'zulkifli-hamdani',
                'type' => 'direksi',
                'position' => 'Direktur Kepatuhan',
                'image' => 'images/perusahaan/zulkifli-hamdani.png',
                'excerpt' => 'Direktur Kepatuhan termuda dengan latar belakang manajemen dan SDM.',
                'profile' => <<<TEXT
Zulkifli Hamdani merupakan lulusan S1 Ekonomi Manajemen Universitas Teknologi Yogyakarta pada tahun 2008. Putra kelahiran Pancor, Lombok Timur ini mengawali karier profesionalnya sebagai Kepala Administrasi dan Keuangan pada PT. Krida Dinamik Autonusa yang bergerak di bidang otomotif.

Pada tahun 2013, beliau memutuskan untuk berkarier di dunia perbankan dengan bergabung di PD. BPR NTB Mataram. Dalam perjalanannya, beliau menduduki jabatan terakhir sebagai Kepala Bagian Umum dan SDM hingga tahun 2019.

Sebagai Direksi termuda di antara seluruh Direksi PD. BPR se-NTB, beliau aktif mengikuti berbagai pelatihan dan pengembangan kompetensi, antara lain Pelatihan Pedoman Perlindungan Konsumen BPR dan Pemasaran Kreatif bagi Pejabat BPR/BPRS, Pelatihan Kompetensi SDM dan Struktur Gaji BPR, Pelatihan Penerapan Good Corporate Governance (GCG), Pelatihan Manajemen Risiko, serta berbagai pelatihan lainnya.

Hingga saat ini, beliau telah mengantongi Sertifikat PBJ Tingkat Dasar yang dikeluarkan oleh Lembaga PPSDM LKPP serta Sertifikat Direktur Tingkat 2 BPR dari Lembaga Sertifikasi Profesi Bidang BPR, BPRS, dan LKM.
TEXT
            ],
        ];

        foreach ($data as $index => $item) {
            DB::table('managements')->updateOrInsert(
                ['slug' => $item['slug']],
                [
                    'name'       => $item['name'],
                    'type'       => $item['type'],
                    'position'   => $item['position'],
                    'image'      => $item['image'] ?? null,
                    'excerpt'    => $item['excerpt'] ?? null,
                    'profile'    => $item['profile'] ?? null,
                    'order'      => $index + 1,
                    'is_active'  => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
