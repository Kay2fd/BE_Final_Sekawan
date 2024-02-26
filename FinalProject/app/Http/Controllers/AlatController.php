<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlatModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;

class alatController extends Controller
{
    protected $alatModel;
    public function __construct()
    {
        $this->alatModel = new AlatModel();
    }
    public function index()
    {
        $alat = $this->alatModel->getAllAlat();

        if ($alat->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'Data produk tidak ditemukan.',
            ], 404);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data produk berhasil didapatkan!',
                'data' => $alat
            ], 200);
        }
    }

    public function show($id)
    {
        $alat = $this->alatModel->find_alat($id);

        if (!$alat) {
            return response()->json([
                'status' => 404,
                'message' => 'Data produk tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Data produk berhasil didapatkan!',
            'data' => $alat
        ], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alat_name' => 'required|string|max:100',
            'alat_stok' => 'required|numeric',
            'alat_price' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data produk gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $alat = $this->alatModel->create_alat($validator->validated());

            return response()->json([
                'status' => 201,
                'message' => 'Data produk berhasil dibuat!',
                'data' => $alat
            ], 201);
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'alat_name' => 'required|string|max:100',
            'alat_stok' => 'required|numeric',
            'alat_price' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data produk gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $alat = $this->alatModel->update_alat($validator->validated(), $id);
            return response()->json([
                'status' => 200,
                'message' => 'Data produk berhasil diupdate!',
                'data' => $alat
            ], 200);
        }
    }
    public function destroy($id)
    {
        $alat = $this->alatModel->delete_alat($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data produk berhasil dihapus!',
            'data' => $alat
        ], 200);
    }
}
