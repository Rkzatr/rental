<?php

namespace App\Database\Seeds;

use App\Models\Alat;
use App\Models\Kategori;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class InitSeeder extends Seeder
{
    public function run()
    {
        Kategori::create([
            'label' => 'Kamera',
            'gambar' => base_url('img/kategori/1.jpg'),
        ]);
        Kategori::create([
            'label' => 'Lensa',
            'gambar' => base_url('img/kategori/2.jpg'),
        ]);
        Kategori::create([
            'label' => 'Flash Eksternal',
            'gambar' => base_url('img/kategori/3.jpeg'),
        ]);
        Kategori::create([
            'label' => 'Tripod',
            'gambar' => base_url('img/kategori/4.jpg'),
        ]);

        $data = [
            [
                "nama" => "Kamera Nikon D5100",
                "kode" => "A001",
                "id_kategori" => "1",
                "gambar" => "http:\/\/rental.project\/img\/alat\/1.jpg",
                "harga" => "100000",
                "stok" => "3",
                "deskripsi" => "1. Sensor dan Resolusi:\r\n- Sensor CMOS DX-format 16.2 megapiksel.\r\n- Prosesor gambar EXPEED 2.\r\n2. Sistem Fokus:\r\n- 11 titik fokus otomatis (AF) dengan sensor AF tipe cross.\r\n3. ISO Range:\r\n- Rentang ISO 100-6400 (dapat diperluas hingga 25,600).\r\n4. Layar LCD:\r\n- Layar sentuh Vari-angle 3 inci dengan resolusi 921,000 titik.\r\n5. Perekaman Video:\r\n- Mampu merekam video Full HD 1080p dengan autofocus kontinu.\r\n6. Fitur Tambahan:\r\n- Mode HDR (High Dynamic Range).\r\n- Efek kreatif dan filter.\r\n- D-Movie mode untuk perekaman video.",
                "created_at" => Time::now(),
                "updated_at" => Time::now(),
            ],
            [
                "nama" => "Kamera Cannon 1300D",
                "kode" => "A002",
                "id_kategori" => "1",
                "gambar" => "http:\/\/rental.project\/img\/alat\/2.jpg",
                "harga" => "100000",
                "stok" => "3",
                "deskripsi" => "1. Sensor dan Resolusi:\r\n- Sensor CMOS APS-C 18.0 megapiksel.\r\n- Prosesor gambar DIGIC 4+.\r\n2. Sistem Fokus:\r\n- 9 titik fokus otomatis dengan satu cross-type.\r\n3. ISO Range:\r\n- Rentang ISO 100-6400 (dapat diperluas hingga 12,800).\r\n4. Layar LCD:\r\n- Layar LCD 3 inci dengan resolusi 920,000 titik.\r\n5. Perekaman Video:\r\n- Mampu merekam video Full HD 1080p dengan mode manual.\r\n6. Fitur Tambahan:\r\n- Wi-Fi dan NFC untuk konektivitas nirkabel.\r\n- Mode pemandangan cerdas (Auto).",
                "created_at" => Time::now(),
                "updated_at" => Time::now(),
            ],
            [
                "nama" => "Lensa Fix Nikon",
                "kode" => "B001",
                "id_kategori" => "2",
                "gambar" => "http:\/\/rental.project\/img\/alat\/3.jpg",
                "harga" => "75000",
                "stok" => "3",
                "deskripsi" => "- Wide Angle Prime Lens\r\n- Filter Size 58mm\r\n- Weight 185g\r\n- Nikon DX Mount with Motor\r\n- NIKON AF-S 50mm f\/1.8G",
                "created_at" => Time::now(),
                "updated_at" => Time::now(),
            ],
            [
                "nama" => "Lensa Fix Cannon",
                "kode" => "B002",
                "id_kategori" => "2",
                "gambar" => "http:\/\/rental.project\/img\/alat\/4.jpg",
                "harga" => "60000",
                "stok" => "3",
                "deskripsi" => "- EF Mount Lens\/Full-Frame Format\r\n- Maximum Aperture f\/1.8\r\n- Optimized Lens Coatings\r\n- STM AF Motor Support Movie Servo AF\r\n- Manual Focus Override\r\n- Metal Lens Mount\r\n- Rounded 7-Blade Diaphragm\r\n- Minimum Focus Distance 14\"",
                "created_at" => Time::now(),
                "updated_at" => Time::now(),
            ],
            [
                "nama" => "Lensa Tele Cannon",
                "kode" => "B003",
                "id_kategori" => "2",
                "gambar" => "http:\/\/rental.project\/img\/alat\/5.jpg",
                "harga" => "100000",
                "stok" => "3",
                "deskripsi" => "- Model A17E\r\n- Filter size 62mm\r\n- Minimum Focus distance 1,5m\r\n- Max. mag. ratio 1:2( at macro 300mm )\r\n- Overall Lenght 119mm (4,7\")\r\n- Maximum diameter 76,6mm\r\n- Weight 460g\r\n- Accesories Lenshood bayonet type.",
                "created_at" => Time::now(),
                "updated_at" => Time::now(),
            ],
            [
                "nama" => "Lensa Tele Nikon",
                "kode" => "B004",
                "id_kategori" => "2",
                "gambar" => "http:\/\/rental.project\/img\/alat\/6.jpg",
                "harga" => "100000",
                "stok" => "3",
                "deskripsi" => "- Focal Length 18 to 140mm (35mm Equivalent Focal Length: 27 to 210mm)\r\n- Maximum Aperture f\/3.5 to 5.6\r\n- Minimum Aperture f\/22 to 38\r\n- Lens Mount Nikon F\r\n- Lens Format Coverage APS-C\r\n- Angle of View 76° to 11° 30'\r\n- Minimum Focus Distance 1.48' \/ 45 cm\r\n- Maximum Magnification 0.23x\r\n- Optical Design 17 Elements in 12 Groups\r\n- Diaphragm Blades 7, Rounded\r\n- Focus Type Autofocus",
                "created_at" => Time::now(),
                "updated_at" => Time::now(),
            ],
            [
                "nama" => "Flash Eksternal ",
                "kode" => "C001",
                "id_kategori" => "3",
                "gambar" => "http:\/\/rental.project\/img\/alat\/7.jpg",
                "harga" => "25000",
                "stok" => "6",
                "deskripsi" => " YN-560 IV bisa mengatur sampai 3 grup.\r\nFitur lain yaitu bisa mengatur fungsi zoom Flash dan level power",
                "created_at" => Time::now(),
                "updated_at" => Time::now(),
            ],
            [
                "nama" => "Tripod",
                "kode" => "D001",
                "id_kategori" => "4",
                "gambar" => "http:\/\/rental.project\/img\/alat\/8.jpg",
                "harga" => "25000",
                "stok" => "6",
                "deskripsi" => "- Technical Specifications of Portable Lightweight Tripod Video & Camera - WT-3520\r\n- Dimension Folded height : 560mm\r\n- Max. height : 1400mm\r\n- Min. height : 545mm\r\n- Max. Tube Diameter : 21.2mm\r\n- Material Aluminium Alloy\r\n- Max Load 3kg",
                "created_at" => Time::now(),
                "updated_at" => Time::now(),
            ]
        ];

        Alat::insert($data);
    }
}
