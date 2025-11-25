<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
// use App\Models\{
//     Pegawai, KontakPegawai , EmployeeIdentifier, EmployeeAssignment,
//     PendidikanPegawai, PerformaPegawai, HistoriGradePegawai,
//     Direktorat, Department, CostCenters, Lokasi, Pekerjaan, Positions,
//     HistoriPosisiPegawai, IndukUnit, EmployeeOrgHistory
// };

// class DummySingleEmployeeSeeder extends Seeder
// {
//     public function run(): void
//     {
//         // Raw dummy row (satu baris) – disusun kembali agar mudah dirawat
//         $raw = [
//             'nip' => '98022',
//             'full_name' => 'Tohnyp',
//             'status_kepegawaian' => 'PKWTT',
//             'contract_type' => 'SDP',
//             'angkatan' => 'SDP 2019',
//             'usia_pensiun' => 56,
//             'gender' => 'Female',
//             'religion' => 'Hindu',
//             'marital_status' => 'Widow',
//             'ptkp' => null,
//             'birth_place' => 'Pinrang',
//             'birth_date' => '23/07/1986',
//             'join_date' => '08/03/2010',
//             'gol_darah' => 'NA',
//             'direktorat_nama' => 'Direktorat Consumer',
//             'kode_induk' => '705',
//             'nama_induk' => 'KCS Makassar',
//             'start_date_induk' => '01/03/2024',
//             'kode_cost_center' => '12700',
//             'nama_cost_center' => 'SHAD',
//             'kode_department' => '50049826',
//             'nama_department' => 'Operation Unit KCS Makassar',
//             'rumpun_divisi' => 'Support',
//             'kode_lokasi' => '705',
//             'nama_lokasi' => 'KCS Makassar',
//             'person_grade_raw' => '3B - Assistant Manager',
//             'start_date_grade' => '01/03/2024',
//             'position_code' => '50073078',
//             'position_name' => 'Operation Unit Head KCS Makassar',
//             'start_date_posisi' => '01/03/2024',
//             'job_code' => '50073451',
//             'job_title' => 'Operation Head KCS 3',
//             'layer_job' => '3A',
//             'job_family' => 'Operation',
//             'rumpun_jabatan' => 'Support',
//             'start_date_job' => '01/03/2024',
//             'valid_grade_min' => '3C',
//             'valid_grade_max' => '3C',
//             'disability_info' => 'No',
//             'disability_type' => 'NA',
//             'email_corporate' => 'user5935@gmail.com',
//             'user_ad' => 'user98022@gmail.com',
//             'no_handphone' => '86401562751',
//             'no_link_aja' => '86401562751',
//             'nik' => '2594900000482630',
//             'no_dplk' => '30895199647',
//             'no_bpjs_kesehatan' => null,
//             'no_bpjs_ketenagakerjaan' => null,
//             'cif' => '73616',
//             'nip_atasan' => '73616',
//             'nama_atasan' => 'Xzzadq',
//             'jenjang_pendidikan' => 'S2',
//             'tahun_lulus' => '2001',
//             'country_pendidikan' => null,
//             'institusi' => 'Universitas Hasanudin',
//             'fakultas' => 'HUKUM',
//             'jurusan' => 'HUKUM INTERNASIONAL',
//             'ipk' => 'NA',
//             'smk_y_3' => 'PR 4',
//             'smk_y_2' => 'PR 2',
//             'smk_y_1' => 'PR 2',
//             'assignment_number' => 'W6230',
//             'global_transfer_flag' => 'Yes',
//         ];

//         // Helpers
//         $parseDate = function (?string $v): ?string {
//             if (!$v || strtoupper($v) === 'NA') return null;
//             $v = trim($v);
//             try {
//                 if (preg_match('#^\d{2}/\d{2}/\d{4}$#', $v)) {
//                     return Carbon::createFromFormat('d/m/Y', $v)->toDateString();
//                 }
//                 return Carbon::parse($v)->toDateString();
//             } catch (\Throwable $e) {
//                 return null;
//             }
//         };
//         $parseGender = fn($g) => strtolower($g) === 'female' ? 'F' : (strtolower($g) === 'male' ? 'M' : null);
//         $parseBool = function ($v): bool {
//             $vv = strtolower((string)$v);
//             return in_array($vv, ['yes','y','true','1']);
//         };
//         $gradeExtract = function (?string $v): ?string {
//             if (!$v) return null;
//             return trim(explode('-', $v, 2)[0]);
//         };
//         $parseSmk = function (?string $v): array {
//             $v = trim((string)$v);
//             if ($v === '' || strtoupper($v) === 'NA') return ['type' => 'SMK','value'=>null];
//             if (preg_match('/^([A-Za-z]+)\s+(\d+(?:\.\d+)?)$/', $v, $m)) {
//                 return ['type' => strtoupper($m[1]), 'value' => (float)$m[2]];
//             }
//             return ['type' => 'SMK', 'value' => null];
//         };

//         // Create/ensure superior (atasan) minimal (dummy)
//         $superior = Pegawai::firstOrCreate(
//             ['nip' => $raw['nip_atasan']],
//             [
//                 'full_name' => $raw['nama_atasan'],
//                 'status_kepegawaian' => 'PKWTT',
//                 'contract_type' => null,
//                 'angkatan' => null,
//                 'gender' => null,
//                 'religion' => null,
//                 'marital_status' => null,
//                 'ptkp' => null,
//                 'birth_place' => null,
//                 'birth_date' => null,
//                 'blood_type' => null,
//                 'usia_pensiun' => null,
//                 'join_date' => null,
//                 'email_corporate' => null,
//                 'user_ad' => null,
//                 'nik' => null,
//                 'disability_flag' => false,
//                 'disability_type' => null,
//                 'cif' => null,
//                 'global_transfer_flag' => false,
//             ]
//         );

//         // Directorate
//         $directorate = Direktorat::firstOrCreate(
//             ['kode_direktorat' => 'DIRCONS'],
//             ['nama_direktorat' => $raw['direktorat_nama']]
//         );

//         // Induk Unit
//         $induk = IndukUnit::firstOrCreate(
//             ['kode_induk' => $raw['kode_induk']],
//             ['nama_induk' => $raw['nama_induk']]
//         );

//         // Cost Center
//         $costCenter = CostCenters::firstOrCreate(
//             ['kode_cost_center' => $raw['kode_cost_center']],
//             ['nama_cost_center' => $raw['nama_cost_center']]
//         );

//         // Department
//         $department = Department::firstOrCreate(
//             ['kode_department' => $raw['kode_department']],
//             ['nama_department' => $raw['nama_department'], 'rumpun_divisi' => $raw['rumpun_divisi']]
//         );

//         // Location
//         $location = Lokasi::firstOrCreate(
//             ['kode_lokasi' => $raw['kode_lokasi']],
//             ['nama_lokasi' => $raw['nama_lokasi'], 'country' => 'Indonesia']
//         );

//         // Job
//         $job = Pekerjaan::updateOrCreate(
//             ['job_code' => $raw['job_code']],
//             [
//                 'job_title' => $raw['job_title'],
//                 'layer_job' => $raw['layer_job'],
//                 'job_family' => $raw['job_family'],
//                 'rumpun_jabatan' => $raw['rumpun_jabatan'],
//                 'valid_grade_min' => $raw['valid_grade_min'],
//                 'valid_grade_max' => $raw['valid_grade_max'],
//                 'is_active' => true
//             ]
//         );

//         // Position
//         $position = Positions::updateOrCreate(
//             ['position_code' => $raw['position_code']],
//             [
//                 'position_name' => $raw['position_name'],
//                 'department_code' => $department->kode_department,
//                 'cost_center_code' => $costCenter->kode_cost_center,
//                 'directorate_code' => $directorate->kode_direktorat,
//                 'location_code' => $location->kode_lokasi,
//                 'job_code' => $job->job_code
//             ]
//         );

//         // Employee main
//         $employee = Pegawai::updateOrCreate(
//             ['nip' => $raw['nip']],
//             [
//                 'full_name' => $raw['full_name'],
//                 'status_kepegawaian' => $raw['status_kepegawaian'],
//                 'contract_type' => $raw['contract_type'],
//                 'angkatan' => $raw['angkatan'],
//                 'gender' => $parseGender($raw['gender']),
//                 'religion' => $raw['religion'],
//                 'marital_status' => $raw['marital_status'],
//                 'ptkp' => $raw['ptkp'],
//                 'birth_place' => $raw['birth_place'],
//                 'birth_date' => $parseDate($raw['birth_date']),
//                 'blood_type' => $raw['gol_darah'] === 'NA' ? null : $raw['gol_darah'],
//                 'usia_pensiun' => $raw['usia_pensiun'],
//                 'join_date' => $parseDate($raw['join_date']),
//                 'email_corporate' => $raw['email_corporate'],
//                 'user_ad' => $raw['user_ad'],
//                 'nik' => $raw['nik'],
//                 'disability_flag' => $parseBool($raw['disability_info']),
//                 'disability_type' => ($raw['disability_type'] === 'NA' ? null : $raw['disability_type']),
//                 'cif' => $raw['cif'],
//                 'global_transfer_flag' => $parseBool($raw['global_transfer_flag']),
//             ]
//         );

//         // Contact
//         KontakPegawai::create([
//             'nip' => $employee->nip,
//             'mobile_phone' => $raw['no_handphone'],
//             'no_link_aja' => $raw['no_link_aja']
//         ]);

//         // Identifiers
//         EmployeeIdentifier::create([
//             'nip' => $employee->nip,
//             'no_dplk' => $raw['no_dplk'],
//             'no_bpjs_kesehatan' => $raw['no_bpjs_kesehatan'],
//             'no_bpjs_ketenagakerjaan' => $raw['no_bpjs_ketenagakerjaan'],
//             'effective_date' => Carbon::now()->toDateString()
//         ]);

//         // Org history (Induk)
//         // EmployeeOrgHistory::firstOrCreate(
//         //     [
//         //         'nip' => $employee->nip,
//         //         'kode_induk' => $induk->kode_induk,
//         //         'start_date_org' => $parseDate($raw['start_date_induk']),
//         //     ],
//         //     []
//         // );

//         // Grade history
//         HistoriGradePegawai::firstOrCreate(
//             [
//                 'nip' => $employee->nip,
//                 'person_grade' => $gradeExtract($raw['person_grade_raw']),
//                 'start_date_grade' => $parseDate($raw['start_date_grade']),
//             ],
//             ['end_date_grade' => null]
//         );

//         // Position history
//         HistoriPosisiPegawai::firstOrCreate(
//             [
//                 'nip' => $employee->nip,
//                 'position_code' => $position->position_code,
//                 'start_date_posisi' => $parseDate($raw['start_date_posisi']),
//             ],
//             [
//                 'atasan_nip' => $superior->nip,
//                 'end_date_posisi' => null
//             ]
//         );

//         // Education
//         PendidikanPegawai::create([
//             'nip' => $employee->nip,
//             'jenjang_code' => $raw['jenjang_pendidikan'],
//             'tahun_lulus' => (int)$raw['tahun_lulus'],
//             'institusi' => $raw['institusi'],
//             'fakultas' => $raw['fakultas'],
//             'jurusan' => $raw['jurusan'],
//             'ipk' => (is_numeric($raw['ipk']) ? (float)$raw['ipk'] : null),
//             'country' => $raw['country_pendidikan']
//         ]);

//         // Performance (SMK)
//         $currentYear = (int) Carbon::now()->year;
//         $smkMap = [
//             'smk_y_3' => $currentYear - 3,
//             'smk_y_2' => $currentYear - 2,
//             'smk_y_1' => $currentYear - 1,
//         ];
//         foreach ($smkMap as $col => $year) {
//             $smk = $parseSmk($raw[$col]);
//             PerformaPegawai::updateOrCreate(
//                 ['nip' => $employee->nip, 'year' => $year, 'score_type' => $smk['type']],
//                 ['score_value' => $smk['value']]
//             );
//         }

//         // Assignment
//         EmployeeAssignment::create([
//             'nip' => $employee->nip,
//             'assignment_number' => $raw['assignment_number'],
//             'global_transfer_flag' => $parseBool($raw['global_transfer_flag']),
//             'start_date' => $parseDate($raw['start_date_posisi']), // asumsi sama dengan start position
//             'end_date' => null,
//             'description' => 'Dummy assignment record'
//         ]);
//     }
// }