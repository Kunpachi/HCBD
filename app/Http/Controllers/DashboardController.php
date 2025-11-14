<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Throwable;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            DB::connection()->getPdo();

            $hasGender     = Schema::hasColumn('users','gender');
            $hasGeneration = Schema::hasColumn('users','generation');
            $hasTalent     = Schema::hasColumn('users','is_talent');
            $hasDisability = Schema::hasColumn('users','has_disability');
            $hasEdu        = Schema::hasColumn('users','education_level');

            $totalEmployees  = User::count();
            $totalTalent     = $hasTalent ? User::where('is_talent',true)->count() : 0;
            $totalDisability = $hasDisability ? User::where('has_disability',true)->count() : 0;

            $male   = $hasGender ? User::where('gender','male')->count() : 0;
            $female = $hasGender ? User::where('gender','female')->count() : 0;

            $genX = $hasGeneration ? User::where('generation','gen_x')->count() : 0;
            $genY = $hasGeneration ? User::where('generation','gen_y')->count() : 0;
            $genZ = $hasGeneration ? User::where('generation','gen_z')->count() : 0;

            $s1 = $hasEdu ? User::where('education_level','s1')->count() : 0;
            $s2 = $hasEdu ? User::where('education_level','s2')->count() : 0;
            $s3 = $hasEdu ? User::where('education_level','s3')->count() : 0;

        } catch (Throwable $e) {
            // Fallback sample
            $totalEmployees  = 12;
            $totalTalent     = 2;
            $totalDisability = 1;
            $male            = 5;
            $female          = 7;
            $genX            = 3;
            $genY            = 5;
            $genZ            = 4;
            $s1              = 8;
            $s2              = 3;
            $s3              = 1;
        }

        $pct = fn($v) => $totalEmployees ? '(' . round($v / $totalEmployees * 100) . '%)' : '(0%)';

        return view('dashboard', [
            'totalEmployees'  => $totalEmployees,
            'totalTalent'     => $totalTalent,
            'totalDisability' => $totalDisability,
            'male'            => $male,
            'female'          => $female,
            'genX'            => $genX,
            'genY'            => $genY,
            'genZ'            => $genZ,
            's1'              => $s1,
            's2'              => $s2,
            's3'              => $s3,
            'malePct'         => $pct($male),
            'femalePct'       => $pct($female),
            'genXPct'         => $pct($genX),
            'genYPct'         => $pct($genY),
            'genZPct'         => $pct($genZ),
            'totalPct'        => $totalEmployees ? '(100%)' : '(0%)',
            'talentPct'       => $pct($totalTalent),
            'disabilityPct'   => $pct($totalDisability),
            's1Pct'           => $pct($s1),
            's2Pct'           => $pct($s2),
            's3Pct'           => $pct($s3),
        ]);
    }
}