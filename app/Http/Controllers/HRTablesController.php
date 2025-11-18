<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HRTablesController extends Controller
{
    public function total(Request $request)
    {
        // Sample data lengkap (tanpa DB). Semua record memiliki:
        // NIP, Nama, Unit, JobTitle, Posisi, Grade, Gender, Generation, Status
        $pegawai = [
            [
                'NIP' => '19800101',
                'Nama' => 'Andi Saputra',
                'Unit' => 'Finance',
                'JobTitle' => 'Staff Finance',
                'Posisi' => 'Staff',
                'Grade' => 'G5',
                'Gender' => 'Male',
                'Generation' => 'Gen X',
                'Status' => 'Aktif',
            ],
            [
                'NIP' => '19840202',
                'Nama' => 'Budi Hartono',
                'Unit' => 'Finance',
                'JobTitle' => 'Senior Analyst',
                'Posisi' => 'Analis',
                'Grade' => 'G6',
                'Gender' => 'Male',
                'Generation' => 'Gen X',
                'Status' => 'Aktif',
            ],
            [
                'NIP' => '19910115',
                'Nama' => 'Hilda Maharani',
                'Unit' => 'HR',
                'JobTitle' => 'HR Generalist',
                'Posisi' => 'Officer',
                'Grade' => 'G5',
                'Gender' => 'Female',
                'Generation' => 'Gen Y',
                'Status' => 'Aktif',
            ],
        ];

        $talent = [
            [
                'NIP' => '19900303',
                'Nama' => 'Citra Lestari',
                'Unit' => 'IT',
                'JobTitle' => 'Team Lead',
                'Posisi' => 'Lead',
                'Grade' => 'G7',
                'Gender' => 'Female',
                'Generation' => 'Gen Y',
                'Status' => 'Talent',
            ],
            [
                'NIP' => '19961212',
                'Nama' => 'Dimas Pratama',
                'Unit' => 'IT',
                'JobTitle' => 'Solution Architect',
                'Posisi' => 'Architect',
                'Grade' => 'G8',
                'Gender' => 'Male',
                'Generation' => 'Gen Z',
                'Status' => 'Talent',
            ],
        ];

        $disability = [
            [
                'NIP' => '19870505',
                'Nama' => 'Dewi Kusuma',
                'Unit' => 'Operations',
                'JobTitle' => 'Support Staff',
                'Posisi' => 'Staff',
                'Grade' => 'G4',
                'Gender' => 'Female',
                'Generation' => 'Gen Y',
                'Status' => 'Aktif',
            ],
        ];

        return view('hr.total', compact('pegawai','talent','disability'));
    }

    public function gender(Request $request)
    {
        $male = [
            ['NIP'=>'19800101','Nama'=>'Andi Saputra','Unit'=>'Finance','JobTitle'=>'Staff Finance','Posisi'=>'Staff','Grade'=>'G5','Gender'=>'Male'],
            ['NIP'=>'19961212','Nama'=>'Dimas Pratama','Unit'=>'IT','JobTitle'=>'Solution Architect','Posisi'=>'Architect','Grade'=>'G8','Gender'=>'Male'],
        ];

        $female = [
            ['NIP'=>'19900303','Nama'=>'Citra Lestari','Unit'=>'IT','JobTitle'=>'Team Lead','Posisi'=>'Lead','Grade'=>'G7','Gender'=>'Female'],
            ['NIP'=>'19870505','Nama'=>'Dewi Kusuma','Unit'=>'Operations','JobTitle'=>'Support Staff','Posisi'=>'Staff','Grade'=>'G4','Gender'=>'Female'],
        ];

        return view('hr.gender', compact('male','female'));
    }

    public function gap(Request $request)
    {
        // Ringkasan kebutuhan vs pensiun vs GAP (per gender) — sample
        $requirementMale      = 12;
        $requirementFemale    = 8;
        $retirementMaleNext   = 2;
        $retirementFemaleNext = 1;
        $currentMale          = 5;
        $currentFemale        = 7;

        $gapMale   = max(0, ($requirementMale + $retirementMaleNext) - $currentMale);
        $gapFemale = max(0, ($requirementFemale + $retirementFemaleNext) - $currentFemale);

        $gapSummary = [
            ['Kategori'=>'Male','Kebutuhan'=>$requirementMale,'Pensiun'=>$retirementMaleNext,'Ada'=>$currentMale,'GAP'=>$gapMale],
            ['Kategori'=>'Female','Kebutuhan'=>$requirementFemale,'Pensiun'=>$retirementFemaleNext,'Ada'=>$currentFemale,'GAP'=>$gapFemale],
        ];

        // Detail karyawan terkait GAP (sample)
        $gapDetails = [
            ['NIP'=>'19751212','Nama'=>'Rudi Santoso','Unit'=>'Finance','JobTitle'=>'Senior Accountant','Posisi'=>'Senior','Grade'=>'G7','Status'=>'Pensiun < 12m'],
            ['NIP'=>'19780101','Nama'=>'Sari Widya','Unit'=>'HR','JobTitle'=>'HR Manager','Posisi'=>'Manager','Grade'=>'G8','Status'=>'Pensiun < 12m'],
            ['NIP'=>'—','Nama'=>'(Posisi Kosong)','Unit'=>'IT','JobTitle'=>'Backend Engineer','Posisi'=>'Engineer','Grade'=>'G6','Status'=>'Formasi Butuh'],
        ];

        return view('hr.gap', compact('gapSummary','gapDetails'));
    }

    public function generation(Request $request)
    {
        $genX = [
            ['NIP'=>'19781212','Nama'=>'Eko Pranoto','Unit'=>'HR','JobTitle'=>'HR Specialist','Posisi'=>'Specialist','Grade'=>'G6','Generation'=>'Gen X'],
        ];
        $genY = [
            ['NIP'=>'19891212','Nama'=>'Fahri Nugraha','Unit'=>'Operations','JobTitle'=>'Ops Supervisor','Posisi'=>'Supervisor','Grade'=>'G6','Generation'=>'Gen Y'],
        ];
        $genZ = [
            ['NIP'=>'20010101','Nama'=>'Gita Rahma','Unit'=>'IT','JobTitle'=>'UI/UX Designer','Posisi'=>'Designer','Grade'=>'G5','Generation'=>'Gen Z'],
        ];

        return view('hr.generation', compact('genX','genY','genZ'));
    }

    public function education(Request $request)
    {
        $bachelor = [
            ['NIP'=>'19920101','Nama'=>'Hanafi Syahputra','Unit'=>'Marketing','JobTitle'=>'Marketing Executive','Posisi'=>'Executive','Grade'=>'G5','Education'=>'Bachelor'],
        ];
        $master = [
            ['NIP'=>'19881111','Nama'=>'Intan Permata','Unit'=>'Finance','JobTitle'=>'Financial Analyst','Posisi'=>'Analyst','Grade'=>'G6','Education'=>'Master'],
        ];
        $doctorate = [
            ['NIP'=>'19750505','Nama'=>'Joko Widodo','Unit'=>'R&D','JobTitle'=>'Research Scientist','Posisi'=>'Scientist','Grade'=>'G8','Education'=>'Doctorate'],
        ];

        return view('hr.education', compact('bachelor','master','doctorate'));
    }
}