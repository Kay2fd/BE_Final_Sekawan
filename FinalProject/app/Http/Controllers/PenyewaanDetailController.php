<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenyewaanDetailModel;
use Illuminate\Support\Facades\Validator;

class PenyewaanDetailController extends Controller
{
    protected $penyewaanDetailModel;
    public function __construct()
    {
        $this->penyewaanDetailModel = new PenyewaanDetailModel();
    }
    public function index()
    {
        $penyewaanDetail = $this->penyewaanDetailModel->getAllPenyewaanDetail();
        return $penyewaanDetail->isEmpty()
            ? response()->json(['status' => 404, 'message' => "Data penyewaan detail tidak ditemukan"], 404)
            : response()->json(['status' => 200, 'message' => "Data penyewaan detail berhasil didapatkan", "data" => $penyewaanDetail], 200);
    }
    public function show($id)
    {
        $penyewaanDetail = $this->penyewaanDetailModel->findPenyewaanDetail($id);
        return $penyewaanDetail
            ? response()->json(["status" => 200, "message" => "Data penyewaan detail berhasil di dapatkan", "data" => $penyewaanDetail], 200)
            : response()->json(["status" => 400, "message" => "Data penyewaan detail berhasil di dapatkan"], 400);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'penyewaan_detail_penyewaan_id' => 'required|exists:penyewaan,penyewaan_id',
            'penyewaan_detail_alat_id' => 'required|exists:alat,alat_id',
            'penyewaan_detail_jumlah' => 'required|integer',
            'penyewaan_detail_subharga' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'message' => 'Validasi pada data Penyewaan Detail gagal!', 'errors' => $validator->errors()], 422);
        }

        $penyewaanDetail = PenyewaanDetailModel::create($validator->validated());
        return response()->json(['status' => 201, 'message' => 'Data Penyewaan Detail berhasil di buat!', 'data' => $penyewaanDetail], 201);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'penyewaan_detail_penyewaan_id' => 'requires|exists:penyewaan,penyewaan_id',
            'penyewaan_detail_alat_id' => 'required|exists:alat,alat_id',
            'penyewaan_detail_jumlah' => 'required|integer',
            'penyewaan_detail_subharga' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['sattus' => 422, 'message' => 'Validasi pada Penyewaan Detail gagal!', 'errors' => $validator->errors()], 422);
        }

        $penyewaanDetail = $this->penyewaanDetailModel->updatePenyewaanDetail($validator->validated(), $id);

        return response()->json(['status' => 200, 'message' => $penyewaanDetail], 200);
    }
    public function destroy($id)
    {
        $penyewaanDetail = $this->penyewaanDetailModel->deletePenyewaanDetail($id);

        return response()->json(['status' => 200, 'message' => 'Data Penyewaan Detail berhasil dihapus!', 'data' => $penyewaanDetail], 200);
    }
}
