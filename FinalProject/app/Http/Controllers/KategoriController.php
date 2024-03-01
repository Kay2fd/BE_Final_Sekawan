<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Validation\ValidationException; 
class KategoriController extends Controller
{
    protected $kategoriModel;

    public function __construct(KategoriModel $kategoriModel) 
    {
        $this->kategoriModel = $kategoriModel;
    }

   public function index()
{
    $kategori = $this->kategoriModel->getAllKategori();

    return $kategori->isEmpty()
        ? response()->json(['status' => 404, 'message' => 'Data kategori tidak ditemukan'], 404)
        : response()->json(['status' => 200, 'message' => 'Data kategori ditemukan', 'kategori' => $kategori], 200);
}

public function show($id)
{
    $kategori = $this->kategoriModel->findKategori($id);

    return $kategori
        ? response()->json(['status' => 200, 'message' => 'Data kategori ditemukan', 'kategori_nama' => $kategori->kategori_nama], 200)
        : response()->json(['status' => 404, 'message' => 'Data kategori tidak ditemukan.'], 404);
}


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_nama' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'message' => 'Validasi pada data kategori gagal!', 'errors' => $validator->errors()], 422);
        }

        $kategoriData = $validator->validated();

        $kategori = $this->kategoriModel->create($kategoriData);

        return response()->json(['status' => 201, 'message' => 'Data kategori berhasil dibuat!', 'data' => $kategori], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kategori_nama' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'message' => 'Validasi pada data kategori gagal!', 'errors' => $validator->errors()], 422);
        }

        $kategoriData = $validator->validated(); 

        $kategori = $this->kategoriModel->updateKategori($kategoriData, $id);

        return response()->json(['status' => 200, 'message' => 'Data kategori berhasil diupdate!', 'data' => $kategori], 200);
    }

    public function destroy($id)
    {
        $kategori = $this->kategoriModel->deleteKategori($id); 

        return response()->json(['status' => 200, 'message' => 'Data kategori berhasil dihapus!', 'data' => $kategori], 200);
    }
}
