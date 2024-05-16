<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Models\DataPosyandu;
use App\Models\DataAnak;

class DataAnakController extends Controller
{
    private $response = [
        'message' => null,
        'data' => null,
    ];
    public function dataAnak(Request $request)
    {
        $user = $request->user();

        $anak = DataAnak::where('no_kk', $user->no_kk)->get();

    if ($anak->isEmpty()) {
        $this->response['message'] = 'Data Anak tidak ditemukan';
        return response()->json($this->response, 404);
    }

    $this->response['message'] = 'Data Anak Ditemukan';
    $this->response['data'] = $anak;

    return response()->json($this->response, 200);
    }

    public function dataGrafik(Request $request) 
    {
        $user = Auth::user();

        $anak = DataAnak::where('no_kk', $user->no_kk)->with('posyandu')->get();

        if ($anak->isEmpty()) {
            $this->response['message'] = 'Data Anak tidak ditemukan';
            return response()->json($this->response, 404);
        }

        $anakData = [];
        foreach ($anak as $item) {
            $posyanduData = [];
            foreach ($item->posyandu as $posyandu) {
                $posyanduData[] = [
                    'tanggal_posyandu' => $posyandu->tanggal_posyandu,
                    'bb_anak' => $posyandu->bb_anak,
                    'tb_anak' => $posyandu->tb_anak,
                    'umur_anak' => $posyandu->umur_anak,
                ];
            }
            $anakData[] = [
                'nama_anak' => $item->nama_anak,
                'jenis_kelamin_anak' => $item->jenis_kelamin_anak,
                'posyandu' => $posyanduData,
            ];
        }
        $this->response['message'] = 'success';
        $this->response['data'] = $anakData;

        return response()->json($this->response, 200);
    }
}
