<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganDataModel;
use Illuminate\Support\Facades\Validator;

class PelangganDataController extends Controller
{
    protected $pelangganDataModel;

    public function __construct()
    {
        $this->pelangganDataModel = new PelangganDataModel();
    }

    public function index()
    {
        $pelangganData = $this->pelangganDataModel->getAllPelangganData();

        return $pelangganData->isEmpty()
            ? response()->json(['status' => 404, 'message' => 'Data pelanggan tidak ditemukan.'], 404)
            : response()->json(['status' => 200, 'message' => 'Data pelanggan berhasil didapatkan!', 'data' => $pelangganData], 200);
    }

    public function show($id)
    {
        $pelangganData = $this->pelangganDataModel->findPelangganData($id);

        return $pelangganData
            ? response()->json(['status' => 200, 'message' => 'Data pelanggan berhasil didapatkan!', 'data' => $pelangganData], 200)
            : response()->json(['status' => 404, 'message' => 'Data pelanggan tidak ditemukan.'], 404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_data_nama' => 'required|string|max:100',
            'pelanggan_data_alamat' => 'required|string|max:100',
            'pelanggan_data_email'  => 'required|string|max:100',
            'pelanggan_data_file' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'message' => 'Validasi pada data pelanggan gagal!', 'errors' => $validator->errors()], 422);
        }

        $pelangganData = $validator->validated();
        $pelangganData = $this->pelangganDataModel->createPelangganData($pelangganData);

        return response()->json(['status' => 201, 'message' => 'Data pelanggan berhasil dibuat!', 'data' => $pelangganData], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_data_nama' => 'required|string|max:100',
            'pelanggan_data_alamat' => 'required|string|max:100',
            'pelanggan_data_email' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'message' => 'Validasi pada data pelanggan gagal!', 'errors' => $validator->errors()], 422);
        }

        $pelangganData = $this->pelangganDataModel->updatePelangganData($validator->validated(), $id);

        return response()->json(['status' => 200, 'message' => 'Data pelanggan berhasil diupdate!', 'data' => $pelangganData], 200);
    }

    public function destroy($id)
    {
        $pelangganData = $this->pelangganDataModel->deletePelangganData($id);

        return response()->json(['status' => 200, 'message' => 'Data pelanggan berhasil dihapus!', 'data' => $pelangganData], 200);
    }
}
