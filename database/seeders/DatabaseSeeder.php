<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductInstance;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'Admin']);
        $staffRole = Role::create(['name' => 'Staff']);
        $managerRole = Role::create(['name' => 'Manager']);

        $admin = User::create([
            'name' => 'Fikri Admin',
            'email' => 'admin@inventsel.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
        ]);

        $staff = User::create([
            'name' => 'Andi Staff Logistik',
            'email' => 'staff@inventsel.com',
            'password' => Hash::make('password'),
            'role_id' => $staffRole->id,
        ]);

        $manager = User::create([
            'name' => 'Budi Manager',
            'email' => 'manager@inventsel.com',
            'password' => Hash::make('password'),
            'role_id' => $managerRole->id,
        ]);

        $users = collect([$admin, $staff, $manager]);
        for ($i = 1; $i <= 5; $i++) {
            $users->push(User::create([
                'name' => "Personil Lapangan $i",
                'email' => "user$i@inventsel.com",
                'password' => Hash::make('password'),
                'role_id' => $staffRole->id,
            ]));
        }

        $catMultimedia = Category::create(['name' => 'Multimedia & Broadcast', 'description' => 'Aset penunjang produksi media, streaming, dan dokumentasi.']);
        $catIT = Category::create(['name' => 'Perangkat IT & Jaringan', 'description' => 'Komputer, laptop, switch, router, dan infrastruktur digital.']);
        $catOffice = Category::create(['name' => 'Fasilitas Kantor', 'description' => 'Sofa, meja, AC, proyektor ruang rapat.']);
        $catTools = Category::create(['name' => 'Perkakas Teknik', 'description' => 'Alat ukur jaringan, crimping tools, soulder station.']);

        $productTemplates = [
            ['nama' => 'Sony Alpha a6000', 'cat' => $catMultimedia->id, 'lokasi' => 'Lemari Studio A', 'kode' => 'CAM-SONY-A6K', 'stok' => 5],
            ['nama' => 'Kamera Lumix G7 K', 'cat' => $catMultimedia->id, 'lokasi' => 'Lemari Studio B', 'kode' => 'CAM-LUMX-G7K', 'stok' => 2],
            ['nama' => 'Wireless Mic Rode Wireless Go', 'cat' => $catMultimedia->id, 'lokasi' => 'Laci Audio 2', 'kode' => 'MIC-RODE-WGO', 'stok' => 6],
            ['nama' => 'Tripod Manfrotto Professional', 'cat' => $catMultimedia->id, 'lokasi' => 'Rak Bawah Studio', 'kode' => 'ACC-TRIP-MANF', 'stok' => 4],
            ['nama' => 'Laptop ASUS ROG Strix', 'cat' => $catIT->id, 'lokasi' => 'Ruang Server Tier 2', 'kode' => 'LAP-ASUS-ROG', 'stok' => 3],
            ['nama' => 'MacBook Pro M2 16 Inch', 'cat' => $catIT->id, 'lokasi' => 'Brankas Utama', 'kode' => 'LAP-APPL-M2P', 'stok' => 4],
            ['nama' => 'Switch Cisco Catalyst 24 Port', 'cat' => $catIT->id, 'lokasi' => 'Rak Jaringan Gedung', 'kode' => 'NET-CSCO-SW24', 'stok' => 8],
            ['nama' => 'MikroTik Routerboard RB4011', 'cat' => $catIT->id, 'lokasi' => 'Rak Jaringan Gedung', 'kode' => 'NET-MIKR-RB40', 'stok' => 1],
            ['nama' => 'Proyektor Epson EB-X400', 'cat' => $catOffice->id, 'lokasi' => 'Ruang Rapat Gelora', 'kode' => 'OFC-PROY-EPSN', 'stok' => 4],
            ['nama' => 'Smart TV LG 55 Inch', 'cat' => $catOffice->id, 'lokasi' => 'Ruang Rapat Utama', 'kode' => 'OFC-LGTV-55I', 'stok' => 2],
            ['nama' => 'AC Split Daikin 1.5 PK', 'cat' => $catOffice->id, 'lokasi' => 'Gudang Inventaris 1', 'kode' => 'OFC-ACDK-15P', 'stok' => 5],
            ['nama' => 'Fluke Network Cable Tester', 'cat' => $catTools->id, 'lokasi' => 'Tas Kit Maintenance', 'kode' => 'TLS-FLUK-NET', 'stok' => 3],
            ['nama' => 'Solder Station Atten ST-80', 'cat' => $catTools->id, 'lokasi' => 'Meja Lab Lab Jaringan', 'kode' => 'TLS-ATTN-ST80', 'stok' => 6],
            ['nama' => 'Tang Crimping AMP Original', 'cat' => $catTools->id, 'lokasi' => 'Kotak Perkakas 1', 'kode' => 'TLS-CRMP-AMP', 'stok' => 10],
            ['nama' => 'Gimbal DJI Ronin SC', 'cat' => $catMultimedia->id, 'lokasi' => 'Lemari Studio A', 'kode' => 'ACC-GIMB-DJIR', 'stok' => 3],
        ];

        $allInstances = collect();

        foreach ($productTemplates as $template) {
            $product = Product::create([
                'nama_barang' => $template['nama'],
                'category_id' => $template['cat'],
                'lokasi_penyimpanan' => $template['lokasi'],
                'kode_barang' => $template['kode'],
                'stok' => $template['stok'],
                'kondisi_barang' => 'Baik', // Menghindari Not Null Violation pada tabel products
                'gambar' => null
            ]);

            for ($j = 1; $j <= $template['stok']; $j++) {
                $kondisi = 'Baik';
                if ($j == $template['stok'] && $template['stok'] > 3) {
                    $kondisi = 'Rusak Ringan';
                }

                $instance = ProductInstance::create([
                    'product_id' => $product->id,
                    'kode_unik' => $template['kode'] . '-' . str_pad($j, 3, '0', STR_PAD_LEFT),
                    'kondisi_barang' => $kondisi,
                    'status_ketersediaan' => 'Tersedia'
                ]);
                $allInstances->push($instance);
            }
        }

        $months = [1, 2, 3, 4, 5, 6, 7];
        $transactionCounts = [12, 8, 15, 22, 14, 19, 5];

        foreach ($months as $index => $month) {
            $count = $transactionCounts[$index];

            for ($k = 0; $k < $count; $k++) {
                $randomUser = $users->random();
                $datePinjam = Carbon::create(2026, $month, rand(1, 25), rand(8, 14), 0, 0);

                $isReturned = $month < 7 ? (rand(1, 10) <= 8) : false;
                $dateKembali = $isReturned ? (clone $datePinjam)->addDays(rand(1, 7)) : null;
                $status = $isReturned ? 'Dikembalikan' : 'Dipinjam';

                $borrowing = Borrowing::create([
                    'user_id' => $randomUser->id,
                    'tanggal_pinjam' => $datePinjam,
                    'tanggal_kembali' => $dateKembali,
                    'status' => $status
                ]);

                $borrowedInstances = $allInstances->random(rand(1, 2));

                foreach ($borrowedInstances as $inst) {
                    BorrowingDetail::create([
                        'borrowing_id' => $borrowing->id,
                        'product_instance_id' => $inst->id
                    ]);

                    if ($status == 'Dipinjam') {
                        $inst->update(['status_ketersediaan' => 'Dipinjam']);
                    }
                }
            }
        }
    }
}