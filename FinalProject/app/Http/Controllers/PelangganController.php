<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganModel;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
    }

    public function index()
    {
        $pelanggan = $this->pelangganModel->getAllpelanggan();

        return $pelanggan->isEmpty()
            ? response()->json(['status' => 404, 'message' => 'Data tidak ditemukan.'], 404)
            : response()->json(['status' => 200, 'message' => 'Data berhasil didapatkan!', 'data' => $pelanggan], 200);
    }

    public function show($id)
    {
        $pelanggan = $this->pelangganModel->find_pelanggan($id);

        return $pelanggan
            ? response()->json(['status' => 200, 'message' => 'Data berhasil didapatkan!', 'data' => $pelanggan], 200)
            : response()->json(['status' => 404, 'message' => 'Data tidak ditemukan.'], 404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_nama' => 'required|string|max:100',
            'pelanggan_alamat' => 'required|string|max:100',
            'pelanggan_email' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'message' => 'Validasi pada data gagal!', 'errors' => $validator->errors()], 422);
        }

        $pelanggan = $this->pelangganModel->create($validator->validated());

        return response()->json(['status' => 201, 'message' => 'Data berhasil dibuat!', 'data' => $pelanggan], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_nama' => 'required|string|max:100',
            'pelanggan_alamat' => 'required|string|max:100',
            'pelanggan_email' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'message' => 'Validasi pada data gagal!', 'errors' => $validator->errors()], 422);
        }

        $pelanggan = $this->pelangganModel->update_pelanggan($validator->validated(), $id);

        return response()->json(['status' => 200, 'message' => 'Data berhasil diupdate!', 'data' => $pelanggan], 200);
    }

    public function destroy($id)
    {
        $pelanggan = $this->pelangganModel->delete_pelanggan($id);

        return response()->json(['status' => 200, 'message' => 'Data berhasil dihapus!', 'data' => $pelanggan], 200);
    }
}
