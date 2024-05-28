<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function schedule(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        if (!$bulan || !$tahun) {
            return response()->json(['error' => 'Bulan dan Tahun Diperlukan'], 400);
        }

        $schedules = JadwalModel::whereRaw('MONTH(STR_TO_DATE(jadwal_posyandu, "%Y-%m-%d")) = ? ', [$bulan])
                                    ->whereRaw('YEAR(STR_TO_DATE(jadwal_posyandu, "%Y-%m-%d")) = ? ', [$tahun])
                                    ->get();

        return response()->json($schedules);
    }
}
