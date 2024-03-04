<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenyewaanModel;
use Illuminate\Support\Facades\Validator;

class PenyewaanController extends Controller
{
    protected $penyewaanModel;

    public function __construct()
    {
        $this->penyewaanModel = new PenyewaanModel();
    }

    public function index()
    {
        $penyewaan = $this->penyewaanModel->getAllPenyewaan();

        return $penyewaan->isEmpty()
            ? response()->json(['status' => 404, 'message' => 'Data penyewaan tidak ditemukan.'], 404)
            : response()->json(['status' => 200, 'message' => 'Data penyewaan berhasil didapatkan!', 'data' => $penyewaan], 200);
    }

    public function show($id)
    {
        $penyewaan = $this->penyewaanModel->findPenyewaan($id);

        return $penyewaan
            ? response()->json(['status' => 200, 'message' => 'Data penyewaan berhasil didapatkan!', 'data' => $penyewaan], 200)
            : response()->json(['status' => 404, 'message' => 'Data penyewaan tidak ditemukan.'], 404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'penyewaan_stts_bayar' => 'required|in:lunas,belum lunas,dp',
            'penyewaan_stts_kembali' => 'required|in:sudah kembali,belum kembali',
            'penyewaan_totalharga' => 'required|integer',
            'penyewaan_pelanggan_id' => 'required|exists:pelanggan,pelanggan_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'message' => 'Validasi pada data penyewaan gagal!', 'errors' => $validator->errors()], 422);
        }

        $penyewaanData = $validator->validated();
        $penyewaan = $this->penyewaanModel->createPenyewaan($penyewaanData);

        return response()->json(['status' => 201, 'message' => 'Data penyewaan berhasil dibuat!', 'data' => $penyewaan], 201);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'penyewaan_stts_bayar' => 'required|in:lunas,belum lunas,dp',
            'penyewaan_stts_kembali' => 'required|in:sudah kembali,belum kembali',
            'penyewaan_totalharga' => 'required|integer',
            'penyewaan_pelanggan_id' => 'required|exists:pelanggan,pelanggan_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'message' => 'Validasi pada data penyewaan gagal!', 'errors' => $validator->errors()], 422);
        }

        $penyewaan = $this->penyewaanModel->updatePenyewaan($validator->validated(), $id);

        return response()->json(['status' => 200, 'message' => 'Data penyewaan berhasil diupdate!', 'data' => $penyewaan], 200);
    }

    public function destroy($id)
    {
        $penyewaan = $this->penyewaanModel->deletePenyewaan($id);

        return response()->json(['status' => 200, 'message' => 'Data penyewaan berhasil dihapus!', 'data' => $penyewaan], 200);
    }
}
