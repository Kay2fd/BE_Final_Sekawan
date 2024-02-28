<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganDataModel; 
use App\Http\Controllers\Controller;
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

        if ($pelangganData->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'Data pelanggan tidak ditemukan.',
            ], 404);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data pelanggan berhasil didapatkan!',
                'data' => $pelangganData
            ], 200);
        }
    }

    public function show($id)
    {
        $pelangganData = $this->pelangganDataModel->findPelangganData($id); 

        if (!$pelangganData) {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Data berhasil didapatkan!',
            'data' => $pelangganData
        ], 200);
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
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $pelangganData = $this->pelangganDataModel->create($validator->validated());

            return response()->json([
                'status' => 201,
                'message' => 'Data pelanggan berhasil dibuat!',
                'data' => $pelangganData
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_data_nama' => 'required|string|max:100',
            'pelanggan_data_alamat' => 'required|string|max:100',
            'pelanggan_data_email' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $pelangganData = $this->pelangganDataModel->updatePelangganData($validator->validated(), $id); 
            return response()->json([
                'status' => 200,
                'message' => 'Data berhasil diupdate!',
                'data' => $pelangganData
            ], 200);
        }
    }

    public function destroy($id)
    {
        $pelangganData = $this->pelangganDataModel->deletePelangganData($id); 
        return response()->json([
            'status' => 200,
            'message' => 'Data berhasil dihapus!',
            'data' => $pelangganData
        ], 200);
    }
}
