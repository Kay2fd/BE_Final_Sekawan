<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function __construct()
{
    $this->middleware('admin.jwt', ['except' => ['login']]);
}
    public function login(Request $request)
    {
        $request->validate([
            'admin_username' => 'required|string',
            'admin_password' => 'required|string',
        ]);

        $admin = Admin::where('admin_username', $request->admin_username)->first();

        if ($admin && Hash::check($request->admin_password, $admin->admin_password)) {
            $token = $admin->createToken('admin_token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'message' => 'Login berhasil!',
                'token' => $token,
            ], 200);
        } else {
            throw ValidationException::withMessages([
                'admin_username' => ['The provided credentials are incorrect.'],
            ]);
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
        $admin = Auth::guard('admin')->user(); 

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
        Auth::guard('admin')->user()->tokens()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Logout berhasil!',
        ], 200);
    }
}
