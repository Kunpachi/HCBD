<?php

namespace App\Imports;

use App\Models\Pegawai;
use App\Models\KontakPegawai;
use App\Models\HistoriPosisiPegawai;
use App\Models\HistoriGradePegawai;
use App\Models\EmployeeIdentifier;
use App\Models\PendidikanPegawai;
use App\Models\PerformaPegawai;
use App\Models\Positions;
use App\Models\Direktorat;
use App\Models\Department;
use App\Models\CostCenter;
use App\Models\Lokasi;
use App\Models\Pekerjaan;
use App\Models\EmployeeAssignment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class PegawaiMasterImport implements OnEachRow, WithHeadingRow
{
    protected array $cfg;

    public function __construct()
    {
        $this->cfg = config('import');
    }

    public function onRow(Row $row)
    {
        $r = $row->toArray(); // snake_case keys

        $nipKey = $this->cfg['pegawai']['nip'];
        $nip = $this->s($r, $nipKey);
        if (!$nip) return;

        DB::transaction(function () use ($r, $nip) {
            // Masters
            $this->upsertMasters($r);

            // Pegawai
            $this->upsertPegawai($r);

            // Kontak
            $this->upsertKontak($r);

            // Histori Grade
            $this->insertHistoriGrade($r);

            // Histori Posisi
            $this->insertHistoriPosisi($r);

            // Histori Induk / Department / Job
            $this->insertHistoriInduk($r);
            $this->insertHistoriDepartment($r);
            $this->insertHistoriJob($r);

            // Pendidikan
            $this->insertPendidikan($r);

            // Performa SMK (3 tahun terakhir)
            $this->upsertPerforma($r);

            // Identifiers
            $this->upsertIdentifiers($r);

            // Assignments
            $this->upsertAssignment($r);
        });
    }

    /* ================= Masters ================= */
    private function upsertMasters(array $r): void
    {
        $m = $this->cfg['masters'];

        // Direktorat
        if ($dirName = $this->s($r, $m['direktorat_name'])) {
            $dirCode = strtoupper(substr(preg_replace('/[^A-Z0-9]/', '_', strtoupper($dirName)),0,30));
            Direktorat::updateOrCreate(
                ['kode_direktorat' => $dirCode],
                ['nama_direktorat' => $dirName]
            );
        }

        // Parent department
        $parentCode = $this->s($r, $m['kode_induk']);
        $parentName = $this->s($r, $m['induk']);
        if ($parentCode || $parentName) {
            $pc = $parentCode ?: strtoupper(substr(preg_replace('/[^A-Z0-9]/','_', strtoupper($parentName)),0,30));
            Department::updateOrCreate(
                ['kode_department' => $pc],
                ['nama_department' => $parentName ?: $parentCode]
            );
        }

        // Department
        $deptCode = $this->s($r, $m['code_department']);
        $deptName = $this->s($r, $m['department']);
        $rumpunDiv = $this->s($r, $m['rumpun_divisi']);
        if ($deptCode || $deptName) {
            Department::updateOrCreate(
                ['kode_department' => $deptCode ?: strtoupper(substr(preg_replace('/[^A-Z0-9]/','_', strtoupper($deptName)),0,30))],
                [
                    'nama_department' => $deptName ?: $deptCode,
                    'rumpun_divisi' => $rumpunDiv,
                    'parent_department' => $parentCode ?: null,
                ]
            );
        }

        // Cost Center
        $ccCode = $this->s($r, $m['kode_cost_center']);
        $ccName = $this->s($r, $m['cost_center']);
        if ($ccCode || $ccName) {
            CostCenter::updateOrCreate(
                ['kode_cost_center' => $ccCode ?: strtoupper(substr(preg_replace('/[^A-Z0-9]/','_', strtoupper($ccName)),0,30))],
                ['nama_cost_center' => $ccName ?: $ccCode]
            );
        }

        // Lokasi
        $locCode = $this->s($r, $m['code_lokasi']);
        $locName = $this->s($r, $m['lokasi']);
        if ($locCode || $locName) {
            Lokasi::updateOrCreate(
                ['kode_lokasi' => $locCode ?: strtoupper(substr(preg_replace('/[^A-Z0-9]/','_', strtoupper($locName)),0,30))],
                ['nama_lokasi' => $locName ?: $locCode]
            );
        }

        // Job
        $jobCode = $this->s($r, $m['job_code']);
        $jobTitle = $this->s($r, $m['job']);
        $layer = $this->s($r, $m['layer_job']);
        $family = $this->s($r, $m['job_family']);
        $rumpunJ = $this->s($r, $m['rumpun_jabatan']);
        $vgMin = $this->s($r, $m['valid_grade_min']);
        $vgMax = $this->s($r, $m['valid_grade_max']);
        if ($jobCode || $jobTitle) {
            Pekerjaan::updateOrCreate(
                ['job_code' => $jobCode ?: strtoupper(substr(preg_replace('/[^A-Z0-9]/','_', strtoupper($jobTitle)),0,30))],
                [
                    'job_title'       => $jobTitle ?: $jobCode,
                    'layer_job'       => $layer,
                    'job_family'      => $family,
                    'rumpun_jabatan'  => $rumpunJ,
                    'valid_grade_min' => $vgMin,
                    'valid_grade_max' => $vgMax,
                    'is_active'       => true,
                ]
            );
        }

        // Position
        $posCode = $this->s($r, $m['position_code']);
        $posName = $this->s($r, $m['position']);
        if ($posCode || $posName) {
            Positions::updateOrCreate(
                ['position_code' => $posCode ?: strtoupper(substr(preg_replace('/[^A-Z0-9]/','_', strtoupper($posName)),0,40))],
                [
                    'position_name'   => $posName ?: $posCode,
                    'department_code' => $deptCode ?: null,
                    'cost_center_code'=> $ccCode ?: null,
                    'directorate_code'=> isset($dirCode) ? $dirCode : null,
                    'location_code'   => $locCode ?: null,
                    'job_code'        => $jobCode ?: null,
                ]
            );
        }
    }

    /* ================= Pegawai ================= */
    private function upsertPegawai(array $r): void
    {
        $c = $this->cfg['pegawai'];
        $payload = [
            'nip'                => $this->s($r, $c['nip']),
            'full_name'          => $this->s($r, $c['full_name']),
            'status_kepegawaian' => $this->s($r, $c['status_kepegawaian']),
            'contract_type'      => $this->s($r, $c['contract_type']),
            'angkatan'           => $this->s($r, $c['angkatan']),
            'gender'             => $this->gender($this->s($r, $c['gender'])),
            'religion'           => $this->s($r, $c['religion']),
            'marital_status'     => $this->s($r, $c['marital_status']),
            'ptkp'               => $this->s($r, $c['ptkp']),
            'birth_place'        => $this->s($r, $c['birth_place']),
            'birth_date'         => $this->d($r, $c['birth_date']),
            'blood_type'         => $this->s($r, $c['blood_type']),
            'usia_pensiun'       => $this->i($r, $c['usia_pensiun']),
            'join_date'          => $this->d($r, $c['join_date']),
            'email_corporate'    => $this->s($r, $c['email_corporate']),
            'user_ad'            => $this->s($r, $c['user_ad']),
            'nik'                => $this->s($r, $c['nik']),
            'disability_flag'    => $this->bool($this->s($r, $c['disability_flag'])) ?? false,
            'disability_type'    => $this->s($r, $c['disability_type']),
            'cif'                => $this->s($r, $c['cif']),
            'global_transfer_flag'=> $this->bool($this->s($r, $c['global_transfer_flag'])) ?? false,
        ];

        Validator::make($payload, [
            'nip' => 'required|string|max:20',
            'email_corporate' => 'nullable|email',
            'birth_date' => 'nullable|date',
            'join_date' => 'nullable|date',
            'gender' => 'nullable|in:M,F',
        ])->validate();

        Pegawai::updateOrCreate(['nip' => $payload['nip']], $payload);
    }

    private function upsertKontak(array $r): void
    {
        $c = $this->cfg['kontak_pegawai'];
        $nip = $this->s($r, $this->cfg['pegawai']['nip']);
        if (!$nip) return;
        $data = [
            'mobile_phone' => $this->s($r, $c['mobile_phone']),
            'no_link_aja'  => $this->s($r, $c['no_link_aja']),
        ];
        if ($data['mobile_phone'] || $data['no_link_aja']) {
            KontakPegawai::updateOrCreate(['nip' => $nip], $data);
        }
    }

    /* ================= Histories ================= */
    private function insertHistoriGrade(array $r): void
    {
        $h = $this->cfg['histori_grade'];
        $nip = $this->s($r, $this->cfg['pegawai']['nip']);
        $grade = $this->s($r, $h['person_grade']);
        $start = $this->d($r, $h['start_date_grade']);
        $masa  = $this->s($r, $h['masa_grade']);
        $end   = $this->endByMasa($start, $masa);
        if ($nip && $grade && $start) {
            $exists = HistoriGradePegawai::where([
                'nip' => $nip,
                'person_grade' => $grade,
                'start_date_grade' => $start,
            ])->exists();
            if (!$exists) {
                HistoriGradePegawai::create([
                    'nip' => $nip,
                    'person_grade' => $grade,
                    'start_date_grade' => $start,
                    'end_date_grade' => $end,
                ]);
            }
        }
    }

    // private function insertHistoriPosisi(array $r): void
    // {
    //     $h = $this->cfg['histori_posisi'];
    //     $nip = $this->s($r, $this->cfg['pegawai']['nip']);
    //     $posCode = $this->s($r, $this->cfg['masters']['position_code']);
    //     $start = $this->d($r, $h['start_date_posisi']);
    //     $masa  = $this->s($r, $h['masa_posisi']);
    //     $end   = $this->endByMasa($start, $masa);
    //     $atasan = $this->s($r, $this->cfg['pegawai']['nip_atasan']);
    //     $namaAtasan = $this->s($r, $this->cfg['pegawai']['nama_atasan']);

    //     if ($nip && $posCode && $start) {
    //         $exists = HistoriPosisiPegawai::where([
    //             'nip' => $nip,
    //             'position_code' => $posCode,
    //             'start_date_posisi' => $start,
    //         ])->exists();
    //         if (!$exists) {
    //             HistoriPosisiPegawai::create([
    //                 'nip' => $nip,
    //                 'position_code' => $posCode,
    //                 'atasan_nip' => $atasan,
    //                 'nama_atasan' => $namaAtasan,
    //                 'start_date_posisi' => $start,
    //                 'end_date_posisi' => $end,
    //             ]);
    //         }
    //     }
    // }
    private function insertHistoriPosisi(array $r): void
    { 
        $h    = $this->cfg['histori_posisi'];
        $nip  = $this->s($r, $this->cfg['pegawai']['nip']);
        $posCode = $this->s($r, $this->cfg['masters']['position_code']);
        $start   = $this->d($r, $h['start_date_posisi']);
        $masa    = $this->s($r, $h['masa_posisi']);
        $end     = $this->endByMasa($start, $masa);

        $atasanNip   = $this->s($r, $this->cfg['pegawai']['nip_atasan']);
        $namaAtasan  = $this->s($r, $this->cfg['pegawai']['nama_atasan']);

        // Validasi dasar
        if (!$nip || !$posCode || !$start) return;

        // Null-kan atasan_nip jika belum ada master pegawai
        if ($atasanNip && !\App\Models\Pegawai::where('nip', $atasanNip)->exists()) {
            $atasanNip = null;
        }

        $exists = \App\Models\HistoriPosisiPegawai::where([
            'nip' => $nip,
            'position_code' => $posCode,
            'start_date_posisi' => $start,
        ])->exists();

        if (!$exists) {
            \App\Models\HistoriPosisiPegawai::create([
                'nip' => $nip,
                'position_code' => $posCode,
                'atasan_nip' => $atasanNip,
                'nama_atasan' => $namaAtasan,
                'start_date_posisi' => $start,
                'end_date_posisi' => $end,
            ]);
        }
    }

    private function insertHistoriInduk(array $r): void
    {
        // Optional: implement if needed (similar pattern)
    }
    private function insertHistoriDepartment(array $r): void
    {
        // Optional: implement
    }
    private function insertHistoriJob(array $r): void
    {
        // Optional: implement
    }

    /* ================= Pendidikan ================= */
    private function insertPendidikan(array $r): void
    {
        $p = $this->cfg['pendidikan'];
        $nip = $this->s($r, $this->cfg['pegawai']['nip']);
        if (!$nip) return;

        $jenjang = $this->s($r, $p['jenjang_code']);
        $institusi = $this->s($r, $p['institusi']);
        if (!$jenjang && !$institusi) return;

        PendidikanPegawai::create([
            'nip'          => $nip,
            'jenjang_code' => $jenjang,
            'tahun_lulus'  => $this->i($r, $p['tahun_lulus']),
            'institusi'    => $institusi,
            'fakultas'     => $this->s($r, $p['fakultas']),
            'jurusan'      => $this->s($r, $p['jurusan']),
            'ipk'          => $this->f($r, $p['ipk']),
            'country'      => $this->s($r, $p['country']),
        ]);
    }

    /* ================= Performa ================= */
    private function upsertPerforma(array $r): void
    {
        $pf = $this->cfg['performa'];
        $nip = $this->s($r, $this->cfg['pegawai']['nip']);
        if (!$nip) return;
        $now = now()->year;
        $map = [
            $now - 3 => $this->f($r, $pf['smk_y_3']),
            $now - 2 => $this->f($r, $pf['smk_y_2']),
            $now - 1 => $this->f($r, $pf['smk_y_1']),
        ];
        foreach ($map as $year => $score) {
            if ($score !== null) {
                PerformaPegawai::updateOrCreate(
                    ['nip' => $nip, 'year' => $year, 'score_type' => $pf['score_type']],
                    ['score_value' => $score]
                );
            }
        }
    }

    /* ================= Identifiers ================= */
    private function upsertIdentifiers(array $r): void
    {
        $id = $this->cfg['employee_identifiers'];
        $nip = $this->s($r, $this->cfg['pegawai']['nip']);
        if (!$nip) return;

        $bpjsTk = $this->firstNonEmpty($r, $id['no_bpjs_ketenagakerjaan']);
        $bpjsKes = $this->firstNonEmpty($r, $id['no_bpjs_kesehatan']);

        if ($bpjsKes || $bpjsTk || $this->s($r, $id['no_dplk'])) {
            EmployeeIdentifier::updateOrCreate(
                ['nip' => $nip, 'effective_date' => now()->toDateString()],
                [
                    'no_dplk' => $this->s($r, $id['no_dplk']),
                    'no_bpjs_kesehatan' => $bpjsKes,
                    'no_bpjs_ketenagakerjaan' => $bpjsTk,
                ]
            );
        }
    }

    /* ================= Assignment ================= */
    private function upsertAssignment(array $r): void
    {
        $a = $this->cfg['assignments'];
        $nip = $this->s($r, $this->cfg['pegawai']['nip']);
        if (!$nip) return;

        $assignNo = $this->s($r, $a['assignment_number']);
        $transfer = $this->bool($this->s($r, $a['global_transfer_flag'])) ?? false;

        if ($assignNo || $transfer) {
            EmployeeAssignment::updateOrCreate(
                ['nip' => $nip, 'assignment_number' => $assignNo ?: ''],
                [
                    'global_transfer_flag' => $transfer,
                    'start_date' => null,
                    'end_date' => null,
                    'description' => null,
                ]
            );
        }
    }

    /* ================= Helpers ================= */
    private function s(array $r, string|array $key): ?string
    {
        if (is_array($key)) {
            foreach ($key as $k) {
                $v = $this->s($r, $k);
                if ($v !== null) return $v;
            }
            return null;
        }
        $v = $r[$key] ?? null;
        if (is_string($v)) {
            $v = trim($v);
            return $v === '' ? null : $v;
        }
        return $v === '' ? null : $v;
    }
    private function i(array $r, string $key): ?int
    {
        $v = $r[$key] ?? null;
        return (is_numeric($v)) ? (int)$v : null;
    }
    private function f(array $r, string $key): ?float
    {
        $v = $r[$key] ?? null;
        if ($v === null || $v === '') return null;
        $v = str_replace(',', '.', preg_replace('/[^0-9\.\-]/','', $v));
        return $v === '' ? null : (float)$v;
    }
    private function d(array $r, string $key): ?string
    {
        $v = $r[$key] ?? null;
        if (!$v) return null;
        try {
            if (is_numeric($v)) {
                return Carbon::instance(ExcelDate::excelToDateTimeObject($v))->toDateString();
            }
            return Carbon::parse($v)->toDateString();
        } catch (\Throwable) { return null; }
    }
    private function bool(?string $v): ?bool
    {
        if ($v === null) return null;
        $x = strtolower($v);
        if (in_array($x, ['1','true','yes','ya','y','on'])) return true;
        if (in_array($x, ['0','false','no','tidak','n','off'])) return false;
        return null;
    }
    private function gender(?string $g): ?string
    {
        if (!$g) return null;
        $x = strtolower($g);
        if (in_array($x, ['m','male','l','laki','laki-laki','pria'])) return 'M';
        if (in_array($x, ['f','female','p','perempuan','wanita'])) return 'F';
        return null;
    }
    private function endByMasa(?string $start, ?string $masa): ?string
    {
        if (!$start || !$masa) return null;
        $m = strtolower(trim($masa));
        preg_match('/(\d+)/', $m, $mm);
        $n = isset($mm[1]) ? (int)$mm[1] : null;
        if (!$n) return null;
        $dt = Carbon::parse($start);
        if (str_contains($m, 'hari') || str_contains($m, 'day')) {
            return $dt->addDays($n)->subDay()->toDateString();
        }
        if (str_contains($m, 'year') || str_contains($m, 'tahun') || str_contains($m, 'th')) {
            return $dt->addYears($n)->subDay()->toDateString();
        }
        return $dt->addMonths($n)->subDay()->toDateString(); // default bulan
    }
    private function firstNonEmpty(array $r, array|string $keys): ?string
    {
        if (is_string($keys)) return $this->s($r, $keys);
        foreach ($keys as $k) {
            $v = $this->s($r, $k);
            if ($v !== null) return $v;
        }
        return null;
    }
}