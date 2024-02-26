<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatModel extends Model
{
    protected $table = 'alat';
    protected $primaryKey = 'alat_id';
    protected $fillable = [
        'alat_nama',
        'alat_stok',
        'alat_hargaperhari',
    ];

    public function getAllAlat()
    {
        return $this->all();
    }
    public function createAlat($data)
    {
        return $this->create($data);
    }

    public function update_alat($data, $id)
    {
        $alat = self::find($id);
        $alat->fill($data);
        $alat->save();
        return $alat;
    }
    public function delete_alat($id)
    {
        $alat = self::find($id);
        if ($alat) {
            $alat->delete();
        }
        return $alat;
    }
}
