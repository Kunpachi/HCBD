<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Excel\SpoutPegawaiImporter;
use OpenSpout\Writer\XLSX\Writer;
use OpenSpout\Common\Entity\Row;
use Illuminate\Support\Facades\Storage;

class SpoutPegawaiImporterTest extends TestCase
{
    use RefreshDatabase;

    protected string $fixturePath;

    // protected function setUp(): void
    // {
    //     parent::setUp();

    //     // Pastikan direktori tests/_data ada
    //     $dir = base_path('tests/_data');
    //     if (!is_dir($dir)) {
    //         mkdir($dir, 0777, true);
    //     }

    //     $this->fixturePath = $dir . DIRECTORY_SEPARATOR . 'pegawai_minimal.xlsx';

    //     // Buat file XLSX kecil dengan Spout
    //     $writer = new Writer();
    //     $writer->openToFile($this->fixturePath);

    //     // Header (harus cocok dengan normalisasi importer)
    //     $writer->addRow(Row::fromValues(['NIP','Full Name','Status','Contract Type','Angkatan','Gender','Email Corporate','User AD','NIK','Join Date','Birth Date']));
    //     // Data row
    //     $writer->addRow(Row::fromValues([
    //         '98001','Pegawai Satu','Aktif','PKWT','2024','M','email1@corp.test','user1','123456789','2024-01-05','1995-02-10'
    //     ]));

    //     $writer->addRow(Row::fromValues([
    //         '98002','Pegawai Dua','Aktif','PKWTT','2023','F','email2@corp.test','user2','987654321','2023-07-15','1990-05-22'
    //     ]));

    //     $writer->close();
    // }

    // public function test_import_minimal_file()
    // {
    //     $this->assertFileExists($this->fixturePath);

    //     $importer = new SpoutPegawaiImporter();
    //     $result = $importer->import($this->fixturePath);

    //     // Asersi dasar
    //     $this->assertIsArray($result);
    //     $this->assertArrayHasKey('inserted', $result);
    //     $this->assertArrayHasKey('updated', $result);
    //     $this->assertArrayHasKey('errors', $result);

    //     // Karena dua baris data baru → inserted >= 2
    //     $this->assertGreaterThanOrEqual(2, $result['inserted']);
    //     $this->assertEquals(0, $result['updated']);

    //     // Pastikan data masuk DB
    //     $this->assertDatabaseHas('pegawai', ['nip' => '98001', 'full_name' => 'Pegawai Satu']);
    //     $this->assertDatabaseHas('pegawai', ['nip' => '98002', 'full_name' => 'Pegawai Dua']);
    // }
}