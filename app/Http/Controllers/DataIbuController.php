<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Models\DataIbu;


class DataIbuController extends Controller
{
    private $response = [
        'message' => null,
        'data' => null,
    ];
    public function register(Request $request)
    {
        $request->validate([
            'email_orang_tua' => 'required|email|unique:orang_tua,email_orang_tua',
            'no_kk' => 'required',
            'nik_ibu' => 'required',
            'nama_ibu' => 'required',
            'tempat_lahir_ibu' => 'required',
            'tanggal_lahir_ibu' => 'required',
            'gol_darah_ibu' => 'required',
            'nik_ayah' => 'required',
            'nama_ayah' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'password_orang_tua'=> 'required',
        ]);

        $data = [
            'email_orang_tua' => $request->email_orang_tua,
            'no_kk' => $request->no_kk,
            'nik_ibu' => $request->nik_ibu,
            'nama_ibu' => $request->nama_ibu,
            'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
            'tanggal_lahir_ibu' => $request->tanggal_lahir_ibu,
            'gol_darah_ibu' => $request->gol_darah_ibu,
            'nik_ayah' => $request->nik_ayah,
            'nama_ayah' => $request->nama_ayah,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'password_orang_tua'=> Hash::make($request->password_orang_tua),
        ];

        try{
            $user = DataIbu::create($data);
            $this->response['data'] = $user;
            $this->response['message'] = 'succsess';
            return response()->json($this->response, 200);
        } catch(QueryException $e){
            $this->response['message'] = 'User Registration Failed: ' .$e->getMessage();
            return response()->json($this->response, 500);
        }
    }
    public function login(Request $req)
    {
        $req->validate([
            'email_orang_tua' => 'required|email',
            'password_orang_tua' => 'required'
        ]);

        $user = DataIbu::where('email_orang_tua', $req->email_orang_tua)->first();

        if (!$user || !Hash::check($req->password_orang_tua, $user->password_orang_tua)) {
            return response()->json([
                'message' => "Email or password is incorrect",
            ], 401); // Unauthorized
        }
        

        $this->response['message'] = 'success';
        $this->response['data'] = [
            'token' => $user->createToken('')->plainTextToken
        ];

        return response()->json($this->response, 200);
    }

    public function me()
    {
        $user = Auth::guard('sanctum')->user();

        $this->response['message'] = 'success';
        $this->response['data'] = $user;

        return response()->json($this->response, 200);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens->each(function ($token) {
            $token->delete();
        });

        $this->response['message'] = 'success';

        return response()->json($this->response, 200);
    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            'email_orang_tua' => 'required|email',
        ]);

        $email = $request->email_orang_tua;

        $existingEmail = DataIbu::where('email_orang_tua', $email)->exists();

        if ($existingEmail) {
            $this->response['message'] = 'true';
        } else {
            $this->response['message'] = 'false';
        }

        return response()->json($this->response, 200);
    }

    public function changePassword(Request $request)
{
    $request->validate([
        'email_orang_tua' => 'required|email',
        'new_password' => 'required|min:6',
    ]);

    $email = $request->email_orang_tua;
    $newPassword = Hash::make($request->new_password);

    $user = DataIbu::where('email_orang_tua', $email)->first();

    if ($user) {
        $user->update(['password_orang_tua' => $newPassword]);
        $this->response['message'] = 'Password successfully updated';
        return response()->json($this->response, 200);
    } else {
        $this->response['message'] = 'User not found';
        return response()->json($this->response, 404);
    }
}

public function dataProfile(Request $request)
{
    $user = $request->user();
        return response()->json(['user' => $user], 200);
}
public function updateProfile(Request $request)
{
    $user = $request->user();

    $request->validate([
        'nama_ibu' => 'sometimes|required',
        'nama_ayah' => 'sometimes|required',
        'alamat' => 'sometimes|required',
        'telepon' => 'sometimes|required|max:13',
    ]);

    $user->nama_ibu = $request->input('nama_ibu', $user->nama_ibu);
    $user->nama_ayah = $request->input('nama_ayah', $user->nama_ayah);
    $user->alamat = $request->input('alamat', $user->alamat);
    $user->telepon = $request->input('telepon', $user->telepon);
    
    $user->save();

    return response()->json(['message' => 'Profil berhasil diperbarui', 'user' => $user], 200);
}
}
