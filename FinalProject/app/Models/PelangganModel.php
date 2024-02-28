<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'pelanggan_id';
    protected $fillable = [
        'pelanggan_nama',
        'pelanggan_alamat',
        'pelanggan_email',
    ];

    public function getAllpelanggan()
    {
        return $this->all();
    }
    public function createpelanggan($data)
    {
        return $this->create($data);
    }

    public function update_pelanggan($data, $id)
    {
        $pelanggan = self::find($id);
        $pelanggan->fill($data);
        $pelanggan->save();
        return $pelanggan;
    }
    public function delete_pelanggan($id)
    {
        $pelanggan = self::find($id);
        if ($pelanggan) {
            $pelanggan->delete();
        }
        return $pelanggan;
    }
}
