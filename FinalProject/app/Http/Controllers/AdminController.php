<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'admin_username' => 'required|string',
            'admin_password' => 'required|string',
        ]);

        $admin = AdminModel::where('admin_username', $request->admin_username)->first();

        if ($admin && Hash::check($request->admin_password, $admin->admin_password)) {
            $token = $this->generateToken($admin);

            return response()->json([
                'status' => 200,
                'message' => 'Login berhasil!',
                'token' => $token,
            ], 200);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Login gagal. Cek kembali username dan password Anda.',
            ], 401);
        }
    }
    

    public function dashboard()
    {
        return response()->json([
            'status' => 200,
            'message' => 'Selamat datang di dashboard admin!',
        ], 200);
    }

    public function update(Request $request)
    {

        $admin = auth()->user(); 

        $admin->update([
            'admin_username' => $request->input('admin_username', $admin->admin_username),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Data berhasil diupdate oleh admin!',
            'data' => $admin,
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Logout berhasil!',
        ], 200);
    }

    private function generateToken($admin)
    {
        $token = $admin->createToken('admin_token')->plainTextToken;

        return $token;
    }
}
