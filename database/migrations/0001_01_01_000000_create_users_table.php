<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     public function up(): void
//     {
//         // Tabel Users (autentikasi)
//         Schema::create('users', function (Blueprint $table) {
//             $table->id();
//             $table->string('name');
//             $table->string('username')->unique();
//             $table->string('email')->unique();
//             $table->timestamp('email_verified_at')->nullable();
//             $table->string('password');
//             $table->string('role')->default('admin');
//             $table->rememberToken();
//             $table->timestamps();
//         });

//         // Password reset
//         Schema::create('password_reset_tokens', function (Blueprint $table) {
//             $table->string('email')->primary();
//             $table->string('token');
//             $table->timestamp('created_at')->nullable();
//         });

//         // Sessions (jika pakai database driver)
//         Schema::create('sessions', function (Blueprint $table) {
//             $table->string('id')->primary();
//             $table->foreignId('user_id')->nullable()->index();
//             $table->string('ip_address', 45)->nullable();
//             $table->text('user_agent')->nullable();
//             $table->longText('payload');
//             $table->integer('last_activity')->index();
//         });

//         // Master Pegawai
//         Schema::create('pegawai', function (Blueprint $table) {
//             $table->string('nip', 20)->primary();
//             $table->string('full_name', 150);
//             $table->string('status_kepegawaian', 30);
//             $table->string('contract_type', 30)->nullable();
//             $table->string('angkatan', 20)->nullable();
//             $table->char('gender', 1)->nullable(); // M/F
//             $table->string('religion', 30)->nullable();
//             $table->string('marital_status', 20)->nullable();
//             $table->string('ptkp', 30)->nullable();
//             $table->string('birth_place', 100)->nullable();
//             $table->date('birth_date')->nullable();
//             $table->string('blood_type', 3)->nullable();
//             $table->smallInteger('usia_pensiun')->nullable();
//             $table->date('join_date')->nullable();
//             $table->string('email_corporate', 120)->nullable()->unique();
//             $table->string('user_ad', 120)->nullable()->unique();
//             $table->string('nik', 50)->nullable()->unique();
//             $table->boolean('disability_flag')->default(false);
//             $table->string('disability_type', 50)->nullable();
//             $table->string('cif', 50)->nullable();
//             $table->boolean('global_transfer_flag')->default(false);
//             $table->timestamps();
//             $table->softDeletes();

//             $table->index(['status_kepegawaian', 'contract_type']);
//             $table->index(['gender', 'angkatan']);
//         });

//         Schema::create('kontak_pegawai', function (Blueprint $table) {
//             $table->id();
//             $table->string('nip', 20);
//             $table->string('mobile_phone', 30)->nullable();
//             $table->string('no_link_aja', 30)->nullable();
//             $table->timestamps();

//             $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
//         });

//         // Master pekerjaan / job
//         Schema::create('pekerjaan', function (Blueprint $table) {
//             $table->string('job_code', 30)->primary();
//             $table->string('job_title', 120);
//             $table->string('layer_job', 30)->nullable();
//             $table->string('job_family', 60)->nullable();
//             $table->string('rumpun_jabatan', 60)->nullable();
//             $table->string('valid_grade_min', 10)->nullable();
//             $table->string('valid_grade_max', 10)->nullable();
//             $table->boolean('is_active')->default(true);
//             $table->timestamps();

//             $table->index(['layer_job', 'job_family']);
//         });

//         Schema::create('direktorat', function (Blueprint $table) {
//             $table->string('kode_direktorat', 20)->primary();
//             $table->string('nama_direktorat', 120);
//             $table->timestamps();
//         });

//         Schema::create('departments', function (Blueprint $table) {
//             $table->string('kode_department', 20)->primary();
//             $table->string('nama_department', 120);
//             $table->string('rumpun_divisi', 60)->nullable();
//             $table->string('parent_department', 20)->nullable();
//             $table->timestamps();

//             $table->foreign('parent_department')->references('kode_department')->on('departments')->nullOnDelete();
//             $table->index('rumpun_divisi');
//         });

//         Schema::create('cost_centers', function (Blueprint $table) {
//             $table->string('kode_cost_center', 20)->primary();
//             $table->string('nama_cost_center', 120);
//             $table->timestamps();
//         });

//         Schema::create('lokasi', function (Blueprint $table) {
//             $table->string('kode_lokasi', 20)->primary();
//             $table->string('nama_lokasi', 120);
//             $table->string('country', 60)->nullable();
//             $table->timestamps();

//             $table->index('country');
//         });

//         // Positions (menghubungkan ke master di atas)
//         Schema::create('positions', function (Blueprint $table) {
//             $table->string('position_code', 30)->primary();
//             $table->string('position_name', 120);
//             $table->string('department_code', 20)->nullable();
//             $table->string('cost_center_code', 20)->nullable();
//             $table->string('directorate_code', 20)->nullable();
//             $table->string('location_code', 20)->nullable();
//             $table->string('job_code', 30)->nullable();
//             $table->timestamps();

//             $table->foreign('department_code')->references('kode_department')->on('departments')->nullOnDelete();
//             $table->foreign('cost_center_code')->references('kode_cost_center')->on('cost_centers')->nullOnDelete();
//             $table->foreign('directorate_code')->references('kode_direktorat')->on('direktorat')->nullOnDelete();
//             $table->foreign('location_code')->references('kode_lokasi')->on('lokasi')->nullOnDelete();
//             $table->foreign('job_code')->references('job_code')->on('pekerjaan')->nullOnDelete();

//             $table->index(['department_code', 'cost_center_code']);
//         });

//         // Histori posisi pegawai
//         Schema::create('histori_posisi_pegawai', function (Blueprint $table) {
//             $table->id();
//             $table->string('nip', 20);
//             $table->string('position_code', 30);
//             $table->string('atasan_nip', 20)->nullable();
//             $table->date('start_date_posisi');
//             $table->date('end_date_posisi')->nullable();
//             $table->timestamps();

//             $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
//             $table->foreign('position_code')->references('position_code')->on('positions')->cascadeOnDelete();
//             $table->foreign('atasan_nip')->references('nip')->on('pegawai')->nullOnDelete();

//             $table->unique(['nip', 'position_code', 'start_date_posisi'], 'hpp_nip_pos_start_unq');
//             $table->index(['nip', 'end_date_posisi'], 'hpp_nip_end_idx');
//         });

//         // Histori grade pegawai
//         Schema::create('histori_grade_pegawai', function (Blueprint $table) {
//             $table->id();
//             $table->string('nip', 20);
//             $table->string('person_grade', 20);
//             $table->date('start_date_grade');
//             $table->date('end_date_grade')->nullable();
//             $table->timestamps();

//             $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
//             $table->index(['nip', 'end_date_grade']);
//         });

//         // Pendidikan pegawai (riwayat)
//         Schema::create('pendidikan_pegawai', function (Blueprint $table) {
//             $table->id();
//             $table->string('nip', 20);
//             $table->string('jenjang_code', 10)->nullable();
//             $table->smallInteger('tahun_lulus')->nullable();
//             $table->string('institusi', 150)->nullable();
//             $table->string('fakultas', 120)->nullable();
//             $table->string('jurusan', 120)->nullable();
//             $table->decimal('ipk', 3, 2)->nullable(); // jika perlu >9.99 gunakan (4,2)
//             $table->string('country', 60)->nullable();
//             $table->timestamps();

//             $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
//             $table->index(['nip', 'jenjang_code']);
//             $table->index('tahun_lulus');
//         });

//         // Performa pegawai
//         Schema::create('performa_pegawai', function (Blueprint $table) {
//             $table->id();
//             $table->string('nip', 20);
//             $table->smallInteger('year');
//             $table->string('score_type', 20)->default('SMK');
//             $table->decimal('score_value', 5, 2)->nullable();
//             $table->timestamps();

//             $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
//             $table->unique(['nip', 'year', 'score_type'], 'performa_unique_nys');
//             $table->index(['year', 'score_type']);
//         });

//         // Identifiers pegawai (nomor-nomor registrasi)
//         Schema::create('employee_identifiers', function (Blueprint $table) {
//             $table->id();
//             $table->string('nip', 20);
//             $table->string('no_dplk', 50)->nullable();
//             $table->string('no_bpjs_kesehatan', 50)->nullable();
//             $table->string('no_bpjs_ketenagakerjaan', 50)->nullable();
//             $table->date('effective_date');
//             $table->timestamps();

//             $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
//             $table->index(['nip', 'effective_date']);
//         });

//         // Assignments pegawai (penugasan / mutasi global)
//         Schema::create('employee_assignments', function (Blueprint $table) {
//             $table->id();
//             $table->string('nip', 20);
//             $table->string('assignment_number', 50)->nullable();
//             $table->boolean('global_transfer_flag')->default(false);
//             $table->date('start_date')->nullable();
//             $table->date('end_date')->nullable();
//             $table->text('description')->nullable();
//             $table->timestamps();

//             $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
//             $table->index(['nip', 'global_transfer_flag']);
//             $table->index(['start_date', 'end_date']);
//         });
//     }

//     public function down(): void
//     {
//         // Drop anak terlebih dahulu untuk hindari FK constraint error
//         Schema::dropIfExists('employee_assignments');
//         Schema::dropIfExists('employee_identifiers');
//         Schema::dropIfExists('performa_pegawai');
//         Schema::dropIfExists('pendidikan_pegawai');
//         Schema::dropIfExists('histori_grade_pegawai');
//         Schema::dropIfExists('histori_posisi_pegawai');
//         Schema::dropIfExists('positions');
//         Schema::dropIfExists('lokasi');
//         Schema::dropIfExists('cost_centers');
//         Schema::dropIfExists('departments');
//         Schema::dropIfExists('direktorat');
//         Schema::dropIfExists('pekerjaan');
//         Schema::dropIfExists('kontak_pegawai');
//         Schema::dropIfExists('pegawai');
//         Schema::dropIfExists('sessions');
//         Schema::dropIfExists('password_reset_tokens');
//         Schema::dropIfExists('users');
//     }
// };

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Users (auth)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('admin');
            $table->rememberToken();
            $table->timestamps();
        });

        // Password reset tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Sessions (optional if using DB driver)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Master Pegawai
        Schema::create('pegawai', function (Blueprint $table) {
            $table->string('nip', 20)->primary();
            $table->string('full_name', 150);
            $table->string('status_kepegawaian', 30);
            $table->string('contract_type', 30)->nullable();
            $table->string('angkatan', 20)->nullable();
            $table->char('gender', 1)->nullable(); // M/F
            $table->string('religion', 30)->nullable();
            $table->string('marital_status', 20)->nullable();
            $table->string('ptkp', 30)->nullable();
            $table->string('birth_place', 100)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('blood_type', 3)->nullable();
            $table->smallInteger('usia_pensiun')->nullable();
            $table->date('join_date')->nullable();
            $table->string('email_corporate', 150)->nullable()->unique();
            $table->string('user_ad', 150)->nullable()->unique();
            $table->string('nik', 50)->nullable()->unique();
            $table->boolean('disability_flag')->default(false);
            $table->string('disability_type', 80)->nullable();
            $table->string('cif', 50)->nullable();
            $table->boolean('global_transfer_flag')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status_kepegawaian', 'contract_type']);
            $table->index(['gender', 'angkatan']);
            $table->index(['religion', 'marital_status']);
        });

        // Kontak Pegawai
        Schema::create('kontak_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20);
            $table->string('mobile_phone', 30)->nullable();
            $table->string('no_link_aja', 30)->nullable();
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
        });

        // Pekerjaan (Job master)
        Schema::create('pekerjaan', function (Blueprint $table) {
            $table->string('job_code', 30)->primary();
            $table->string('job_title', 150);
            $table->string('layer_job', 40)->nullable();
            $table->string('job_family', 80)->nullable();
            $table->string('rumpun_jabatan', 80)->nullable();
            $table->string('valid_grade_min', 10)->nullable();
            $table->string('valid_grade_max', 10)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['layer_job', 'job_family']);
            $table->index(['valid_grade_min', 'valid_grade_max']);
        });

        // Direktorat
        Schema::create('direktorat', function (Blueprint $table) {
            $table->string('kode_direktorat', 30)->primary();
            $table->string('nama_direktorat', 150);
            $table->timestamps();
        });

        // Departments
        Schema::create('departments', function (Blueprint $table) {
            $table->string('kode_department', 30)->primary();
            $table->string('nama_department', 150);
            $table->string('rumpun_divisi', 80)->nullable();
            $table->string('parent_department', 30)->nullable();
            $table->timestamps();

            $table->foreign('parent_department')->references('kode_department')->on('departments')->nullOnDelete();
            $table->index('rumpun_divisi');
        });

        // Cost Centers
        Schema::create('cost_centers', function (Blueprint $table) {
            $table->string('kode_cost_center', 30)->primary();
            $table->string('nama_cost_center', 150);
            $table->timestamps();
        });

        // Lokasi
        Schema::create('lokasi', function (Blueprint $table) {
            $table->string('kode_lokasi', 30)->primary();
            $table->string('nama_lokasi', 150);
            $table->string('country', 80)->nullable();
            $table->timestamps();

            $table->index('country');
        });

        // Positions
        Schema::create('positions', function (Blueprint $table) {
            $table->string('position_code', 40)->primary();
            $table->string('position_name', 150);
            $table->string('department_code', 30)->nullable();
            $table->string('cost_center_code', 30)->nullable();
            $table->string('directorate_code', 30)->nullable();
            $table->string('location_code', 30)->nullable();
            $table->string('job_code', 30)->nullable();
            $table->timestamps();

            $table->foreign('department_code')->references('kode_department')->on('departments')->nullOnDelete();
            $table->foreign('cost_center_code')->references('kode_cost_center')->on('cost_centers')->nullOnDelete();
            $table->foreign('directorate_code')->references('kode_direktorat')->on('direktorat')->nullOnDelete();
            $table->foreign('location_code')->references('kode_lokasi')->on('lokasi')->nullOnDelete();
            $table->foreign('job_code')->references('job_code')->on('pekerjaan')->nullOnDelete();
            $table->index(['department_code', 'cost_center_code']);
        });

        // Histori Posisi
        Schema::create('histori_posisi_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20);
            $table->string('position_code', 40);
            $table->string('atasan_nip', 20)->nullable();
            $table->string('nama_atasan', 150)->nullable();
            $table->date('start_date_posisi');
            $table->date('end_date_posisi')->nullable();
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
            $table->foreign('position_code')->references('position_code')->on('positions')->cascadeOnDelete();
            $table->foreign('atasan_nip')->references('nip')->on('pegawai')->nullOnDelete();

            $table->unique(['nip', 'position_code', 'start_date_posisi'], 'hist_pos_unique');
            $table->index(['nip', 'end_date_posisi']);
        });

        // Histori Grade
        Schema::create('histori_grade_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20);
            $table->string('person_grade', 30);
            $table->date('start_date_grade');
            $table->date('end_date_grade')->nullable();
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
            $table->index(['nip', 'end_date_grade']);
        });

        // Histori Induk (parent department tenure)
        Schema::create('histori_induk_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20);
            $table->string('parent_department', 30);
            $table->date('start_date_induk');
            $table->date('end_date_induk')->nullable();
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
            $table->foreign('parent_department')->references('kode_department')->on('departments')->cascadeOnDelete();
            $table->unique(['nip', 'parent_department', 'start_date_induk'], 'hist_induk_unique');
        });

        // Histori Department
        Schema::create('histori_department_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20);
            $table->string('department_code', 30);
            $table->date('start_date_department');
            $table->date('end_date_department')->nullable();
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
            $table->foreign('department_code')->references('kode_department')->on('departments')->cascadeOnDelete();
            $table->unique(['nip', 'department_code', 'start_date_department'], 'hist_dept_unique');
        });

        // Histori Job
        Schema::create('histori_job_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20);
            $table->string('job_code', 30);
            $table->date('start_date_job');
            $table->date('end_date_job')->nullable();
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
            $table->foreign('job_code')->references('job_code')->on('pekerjaan')->cascadeOnDelete();
            $table->unique(['nip', 'job_code', 'start_date_job'], 'hist_job_unique');
        });

        // Pendidikan
        Schema::create('pendidikan_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20);
            $table->string('jenjang_code', 20)->nullable();
            $table->smallInteger('tahun_lulus')->nullable();
            $table->string('institusi', 180)->nullable();      // Nama institusi
            $table->string('fakultas', 150)->nullable();
            $table->string('jurusan', 150)->nullable();
            $table->decimal('ipk', 4, 2)->nullable();
            $table->string('country', 80)->nullable();
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
            $table->index(['nip', 'jenjang_code']);
            $table->index('tahun_lulus');
        });

        // Performa
        Schema::create('performa_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20);
            $table->smallInteger('year');
            $table->string('score_type', 20)->default('SMK');
            $table->decimal('score_value', 6, 2)->nullable();
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
            $table->unique(['nip', 'year', 'score_type'], 'performa_nys_unique');
            $table->index(['year', 'score_type']);
        });

        // Identifiers
        Schema::create('employee_identifiers', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20);
            $table->string('no_dplk', 60)->nullable();
            $table->string('no_bpjs_kesehatan', 60)->nullable();
            $table->string('no_bpjs_ketenagakerjaan', 60)->nullable();
            $table->date('effective_date');
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
            $table->index(['nip', 'effective_date']);
        });

        // Assignments
        Schema::create('employee_assignments', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20);
            $table->string('assignment_number', 60)->nullable();
            $table->boolean('global_transfer_flag')->default(false);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
            $table->index(['nip', 'global_transfer_flag']);
            $table->index(['start_date', 'end_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_assignments');
        Schema::dropIfExists('employee_identifiers');
        Schema::dropIfExists('performa_pegawai');
        Schema::dropIfExists('pendidikan_pegawai');
        Schema::dropIfExists('histori_job_pegawai');
        Schema::dropIfExists('histori_department_pegawai');
        Schema::dropIfExists('histori_induk_pegawai');
        Schema::dropIfExists('histori_grade_pegawai');
        Schema::dropIfExists('histori_posisi_pegawai');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('lokasi');
        Schema::dropIfExists('cost_centers');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('direktorat');
        Schema::dropIfExists('pekerjaan');
        Schema::dropIfExists('kontak_pegawai');
        Schema::dropIfExists('pegawai');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};