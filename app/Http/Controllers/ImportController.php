<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PegawaiMasterImport;

class ImportController extends Controller
{
    public function form()
    {
        return view('import.pegawai');
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|mimes:xlsx,xls|max:20480', // naikkan ke 20MB jika perlu
            ]);

            $file = $request->file('file');
            if (!$file) {
                throw new \RuntimeException('File tidak diterima oleh server.');
            }

            // DEBUG: tes dulu apakah file bisa dibaca sebelum import penuh
            // Matikan sementara Excel::import jika ingin memastikan sheet terbaca
            // $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
            // $sheetNames = $spreadsheet->getSheetNames();
            // return $this->respond($request, ['status'=>'ok','sheets'=>$sheetNames,'filename'=>$file->getClientOriginalName()]);

            Excel::import(new PegawaiMasterImport, $file);

            return $this->respond($request, [
                'status' => 'ok',
                'message' => 'Import selesai.',
            ], redirectOnNonAjax: true);

        } catch (\Throwable $e) {
            Log::error('Import gagal: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return $this->respond($request, [
                'status' => 'error',
                'message' => $e->getMessage(),
                'class' => get_class($e),
            ], status: 500);
        }
    }

    private function respond(Request $request, array $payload, int $status = 200, bool $redirectOnNonAjax = false)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json($payload, $status);
        }

        if ($redirectOnNonAjax) {
            if ($status === 200) {
                return redirect()->route('import.pegawai.form')->with('success', $payload['message'] ?? 'OK');
            }
            return redirect()->route('import.pegawai.form')->withErrors(['import' => $payload['message'] ?? 'Gagal']);
        }

        return response()->json($payload, $status);
    }
}