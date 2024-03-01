<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlatModel;
use Illuminate\Support\Facades\Validator;

class AlatController extends Controller
{
    protected $alatModel;

    public function __construct()
    {
        $this->alatModel = new AlatModel();
    }

    public function index()
    {
        $alat = $this->alatModel->getAllAlat();

        return $alat->isEmpty()
            ? response()->json(['status' => 404, 'message' => 'Data produk tidak ditemukan.'], 404)
            : response()->json(['status' => 200, 'message' => 'Data produk berhasil didapatkan!', 'data' => $alat], 200);
    }

    public function show($id)
    {
        $alat = $this->alatModel->find_alat($id);

        return $alat
            ? response()->json(['status' => 200, 'message' => 'Data produk berhasil didapatkan!', 'data' => $alat], 200)
            : response()->json(['status' => 404, 'message' => 'Data produk tidak ditemukan.'], 404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alat_nama' => 'required|string|max:100',
            'alat_stok' => 'required|numeric',
            'alat_hargaperhari' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'message' => 'Validasi pada data produk gagal!', 'errors' => $validator->errors()], 422);
        }

        $alatData = $validator->validated();
        $alat = $this->alatModel->create($alatData);

        return response()->json(['status' => 201, 'message' => 'Data produk berhasil dibuat!', 'data' => $alat], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'alat_nama' => 'required|string|max:100',
            'alat_stok' => 'required|numeric',
            'alat_hargaperhari' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'message' => 'Validasi pada data produk gagal!', 'errors' => $validator->errors()], 422);
        }

        $alatData = $validator->validated();
        $alat = $this->alatModel->update_alat($alatData, $id);

        return response()->json(['status' => 200, 'message' => 'Data produk berhasil diupdate!', 'data' => $alat], 200);
    }

    public function destroy($id)
    {
        $alat = $this->alatModel->delete_alat($id);
        return response()->json(['status' => 200, 'message' => 'Data produk berhasil dihapus!', 'data' => $alat], 200);
    }
}
