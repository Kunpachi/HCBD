<?php
// return [
//     'pegawai' => [
//         'nip'                => 'NIP',
//         'full_name'          => 'Full Name',
//         'gender'             => 'Gender',
//         'email_corporate'    => 'Email Corp',
//         'status_kepegawaian' => 'Employment Status', // contoh jika ada
//         'contract_type'      => 'Contract Type',
//         'angkatan'           => 'Batch',
//         'join_date'          => 'Join Date',
//     ],
//     'kontak_pegawai' => [
//         'nip'          => 'NIP',
//         'mobile_phone' => 'Mobile Phone',
//         'no_link_aja'  => 'LinkAja',
//     ],
//     'histori_posisi_pegawai' => [
//         'nip'              => 'NIP',
//         'position_code'    => 'Position Code',
//         'start_date_posisi'=> 'Position Start Date',
//         'atasan_nip'       => 'Atasan NIP',
//     ],
//     'histori_grade_pegawai' => [
//         'nip'            => 'NIP',
//         'person_grade'   => 'Grade',
//         'start_date_grade'=> 'Grade Start',
//     ],
//     'pendidikan_pegawai' => [
//         'nip'         => 'NIP',
//         'jenjang_code'=> 'Jenjang',
//         'institusi'   => 'Institusi',
//         'tahun_lulus' => 'Tahun Lulus',
//         'ipk'         => 'IPK',
//         'jurusan'     => 'Jurusan',
//     ],
//     'performa_pegawai' => [
//         'nip'        => 'NIP',
//         'year'       => 'Year Performance',
//         'score_type' => 'Score Type',
//         'score_value'=> 'Score Value',
//     ],
//     'employee_identifiers' => [
//         'nip'                    => 'NIP',
//         'no_bpjs_kesehatan'      => 'No BPJS Kesehatan',
//         'no_bpjs_ketenagakerjaan'=> 'No BPJS Ketenagakerjaan',
//         'no_dplk'                => 'DPLK',
//         'effective_date'         => 'Effective Identifiers',
//     ],
// ];

// return [

//     // Pegawai (master)
//     'pegawai' => [
//         'nip'                 => 'NIP',
//         'full_name'           => 'Full Name',
//         'status_kepegawaian'  => 'Status',
//         'contract_type'       => 'Contract Type',
//         'angkatan'            => 'Angkatan',
//         'gender'              => 'Gender',
//         'religion'            => 'Religion',
//         'marital_status'      => 'Marr. Status',
//         'ptkp'                => 'PTKP',
//         'birth_place'         => 'Birth Place',
//         'birth_date'          => 'Birth Date',
//         // Age -> dihitung dari birth_date (tidak disimpan)
//         'join_date'           => 'Join Date',
//         // Masa Kerja -> dihitung (tidak disimpan)
//         'blood_type'          => 'Gol Darah',
//         'usia_pensiun'        => 'Usia Pensiun', // jika ada; jika tidak hapus
//         'email_corporate'     => 'Email Corporate',
//         'user_ad'             => 'User AD',
//         'nik'                 => 'NIK',
//         'disability_flag'     => 'Disability Info',
//         'disability_type'     => 'Disability Type',
//         'cif'                 => 'CIF',
//         'global_transfer_flag'=> 'Global Transfer Flag',
//         'nip_atasan'          => 'NIP Atasan',
//         'nama_atasan'         => 'Nama Atasan',
//     ],

//     // Kontak pegawai
//     'kontak_pegawai' => [
//         'mobile_phone'        => 'No Handphone',
//         'no_link_aja'         => 'No Link Aja',
//     ],

//     // Masters
//     'masters' => [
//         'direktorat_name'     => 'Direktorat',
//         'kode_induk'          => 'Kode Induk',
//         'induk'               => 'Induk',
//         'kode_cost_center'    => 'Kode Cost Center',
//         'cost_center'         => 'Cost Center',
//         'code_department'     => 'Code Department',
//         'department'          => 'Department',
//         'rumpun_divisi'       => 'Rumpun Divisi',
//         'code_lokasi'         => 'Code Lokasi',
//         'lokasi'              => 'Lokasi',
//         'job_code'            => 'Job Code',
//         'job'                 => 'Job',
//         'layer_job'           => 'Layer Job',
//         'job_family'          => 'Job Family',
//         'rumpun_jabatan'      => 'Rumpun Jabatan',
//         'valid_grade_min'     => 'Valid Grade Min',
//         'valid_grade_max'     => 'Valid Grade Max',
//         'position_code'       => 'Position Code',
//         'position'            => 'Position',
//     ],

//     // Histori Induk
//     'histori_induk' => [
//         'start_date_induk'    => 'Start Date induk',
//         'masa_induk'          => 'Masa Induk',
//     ],

//     // Histori Department
//     'histori_department' => [
//         'start_date_department' => 'Start Date Department', // jika ada header; kalau tidak ganti
//         'masa_department'       => 'Masa Department',
//     ],

//     // Histori Job
//     'histori_job' => [
//         'start_date_job'      => 'Start Date Job',
//         'masa_job'            => 'Masa Job',
//     ],

//     // Histori Posisi
//     'histori_posisi' => [
//         'start_date_posisi'   => 'Start Date Posisi',
//         'masa_posisi'         => 'Masa Posisi',
//     ],

//     // Histori Grade
//     'histori_grade' => [
//         'person_grade'        => 'Person Grade',
//         'start_date_grade'    => 'Start Date Masa Grade',
//         'masa_grade'          => 'Masa Grade',
//     ],

//     // Pendidikan
//     'pendidikan' => [
//         'jenjang_code'        => 'Jenjang Pendidikan',
//         'tahun_lulus'         => 'Tahun Lulus',
//         'country'             => 'Country',
//         'institusi'           => 'Nama institusi',
//         'fakultas'            => 'Fakultas',
//         'jurusan'             => 'Jurusan',
//         'ipk'                 => 'IPK',
//     ],

//     // Performa (SMK)
//     'performa' => [
//         'smk_y_3'             => 'SMK Y-3',
//         'smk_y_2'             => 'SMK Y-2',
//         'smk_y_1'             => 'SMK Y-1',
//         'score_type'          => 'SMK', // constant
//     ],

//     // Identifiers
//     'employee_identifiers' => [
//         'no_dplk'             => 'No DPLK',
//         'no_bpjs_kesehatan'   => ['No.BPJS Kesehatan', 'No BPJS Kesehatan'],
//         'no_bpjs_ketenagakerjaan' => ['No BPS Ketenagakerjaan', 'No BPJS Ketenagakerjaan'],
//     ],

//     // Assignments
//     'assignments' => [
//         'assignment_number'   => 'Assignment Number',
//         'global_transfer_flag'=> 'Global Transfer Flag',
//     ],
// ];

return [
    'pegawai' => [
        'nip'                   => 'nip',
        'full_name'             => 'full_name',
        'status_kepegawaian'    => 'status',
        'contract_type'         => 'contract_type',
        'angkatan'              => 'angkatan',
        'gender'                => 'gender',
        'religion'              => 'religion',
        'marital_status'        => 'marr_status',
        'ptkp'                  => 'ptkp',
        'birth_place'           => 'birth_place',
        'birth_date'            => 'birth_date',
        'join_date'             => 'join_date',
        'blood_type'            => 'gol_darah',
        'usia_pensiun'          => 'usia_pensiun',
        'email_corporate'       => 'email_corporate',
        'user_ad'               => 'user_ad',
        'nik'                   => 'nik',
        'disability_flag'       => 'disability_info',
        'disability_type'       => 'disability_type',
        'cif'                   => 'cif',
        'global_transfer_flag'  => 'global_transfer_flag',
        'nip_atasan'            => 'nip_atasan',
        'nama_atasan'           => 'nama_atasan',
    ],

    'kontak_pegawai' => [
        'mobile_phone' => 'no_handphone',
        'no_link_aja'  => 'no_link_aja',
    ],

    'masters' => [
        'direktorat_name'  => 'direktorat',
        'kode_induk'       => 'kode_induk',
        'induk'            => 'induk',
        'kode_cost_center' => 'kode_cost_center',
        'cost_center'      => 'cost_center',
        'code_department'  => 'code_department',
        'department'       => 'department',
        'rumpun_divisi'    => 'rumpun_divisi',
        'code_lokasi'      => 'code_lokasi',
        'lokasi'           => 'lokasi',
        'job_code'         => 'job_code',
        'job'              => 'job',
        'layer_job'        => 'layer_job',
        'job_family'       => 'job_family',
        'rumpun_jabatan'   => 'rumpun_jabatan',
        'valid_grade_min'  => 'valid_grade_min',
        'valid_grade_max'  => 'valid_grade_max',
        'position_code'    => 'position_code',
        'position'         => 'position',
    ],

    'histori_induk' => [
        'start_date_induk' => 'start_date_induk',
        'masa_induk'       => 'masa_induk',
    ],
    'histori_department' => [
        'start_date_department' => 'start_date_department',
        'masa_department'       => 'masa_department',
    ],
    'histori_job' => [
        'start_date_job'   => 'start_date_job',
        'masa_job'         => 'masa_job',
    ],
    'histori_posisi' => [
        'start_date_posisi'=> 'start_date_posisi',
        'masa_posisi'      => 'masa_posisi',
    ],
    'histori_grade' => [
        'person_grade'     => 'person_grade',
        'start_date_grade' => 'start_date_masa_grade',
        'masa_grade'       => 'masa_grade',
    ],

    'pendidikan' => [
        'jenjang_code'     => 'jenjang_pendidikan',
        'tahun_lulus'      => 'tahun_lulus',
        'country'          => 'country',
        'institusi'        => 'nama_institusi',
        'fakultas'         => 'fakultas',
        'jurusan'          => 'jurusan',
        'ipk'              => 'ipk',
    ],

    'performa' => [
        'smk_y_3'          => 'smk_y_3',
        'smk_y_2'          => 'smk_y_2',
        'smk_y_1'          => 'smk_y_1',
        'score_type'       => 'SMK',
    ],

    'employee_identifiers' => [
        'no_dplk'               => 'no_dplk',
        'no_bpjs_kesehatan'     => ['no_bpjs_kesehatan', 'no_bpjs__kesehatan','no_bpjs_kesehatan_'], // fallback if variation
        'no_bpjs_ketenagakerjaan'=> ['no_bps_ketenagakerjaan','no_bpjs_ketenagakerjaan'],
    ],

    'assignments' => [
        'assignment_number' => 'assignment_number',
        'global_transfer_flag' => 'global_transfer_flag',
    ],
];