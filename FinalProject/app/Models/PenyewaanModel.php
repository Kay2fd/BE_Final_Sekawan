<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyewaanModel extends Model
{
    protected $table = 'penyewaan';
    protected $primaryKey = 'penyewaan_id';
    protected $fillable = [
        'penyewaan_pelanggan_id',
        'penyewaan_tgl_sewa',
        'penyewaan_stts_bayar',
        'penyewaan_stts_kembali',
        'penyewaan_totalharga',
    ];

    public function getAllPenyewaan()
    {
        return $this->all();
    }

    public function findPenyewaan($id)
    {
        return $this->find($id);
    }

    public function createPenyewaan($data)
    {
        return $this->create($data);
    }

    public function updatePenyewaan($data, $id)
    {
        $penyewaan = $this->find($id);
        $penyewaan->fill($data);
        $penyewaan->save();

        return $penyewaan;
    }

    public function deletePenyewaan($id)
    {
        $penyewaan = $this->find($id);

        if ($penyewaan) {
            $penyewaan->delete();
        }

        return $penyewaan;
    }
}
