<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
// use App\Models\{
//     Pegawai, Pekerjaan, Direktorat, Department,
//     CostCenters, Lokasi, Positions, HistoriPosisiPegawai
// };

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // // Master reference minimal
        // Direktorat::factory()->count(3)->create([
        //     // Anda bisa buat Factory jika ingin lebih dinamis
        // ]);

        // // Alternatif tanpa factory (manual)
        // Direktorat::firstOrCreate(['kode_direktorat' => 'DIR001'], ['nama_direktorat' => 'Direktorat Operasi']);
        // Department::firstOrCreate(['kode_department' => 'DEP001'], ['nama_department' => 'Departemen IT']);
        // CostCenters::firstOrCreate(['kode_cost_center' => 'CC001'], ['nama_cost_center' => 'IT Shared']);
        // Lokasi::firstOrCreate(['kode_lokasi' => 'LOC01'], ['nama_lokasi' => 'Jakarta', 'country' => 'Indonesia']);
        // Pekerjaan::firstOrCreate(['job_code' => 'JOB001'], [
        //     'job_title' => 'Software Engineer',
        //     'layer_job' => 'Staff',
        //     'job_family' => 'Engineering',
        //     'rumpun_jabatan' => 'Teknologi',
        //     'valid_grade_min' => '09',
        //     'valid_grade_max' => '12',
        //     'is_active' => true
        // ]);

        // Pegawai::factory()->count(10)->create();

        // // Create positions
        // Positions::factory()->count(5)->create();

        // // Assign current position histories
        // $positions = Positions::all();
        // Pegawai::all()->each(function ($emp) use ($positions) {
        //     $pos = $positions->random();
        //     HistoriPosisiPegawai::create([
        //         'nip' => $emp->nip,
        //         'position_code' => $pos->position_code,
        //         'atasan_nip' => null,
        //         'start_date_posisi' => now()->subMonths(rand(1, 30))
        //     ]);
        // });

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => 'password123', // auto-hash oleh mutator pada model
                'role' => 'admin',
            ]
        );
    }
}