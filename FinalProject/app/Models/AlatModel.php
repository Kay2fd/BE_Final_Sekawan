<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatModel extends Model
{
    protected $table = 'alat';
    protected $primaryKey = 'alat_id';
    protected $fillable = [
        'alat_name',
        'alat_stok',
        'alat_price',
    ];

    public function getAllAlat()
    {
        return $this->all();
    }
    public function createAlat($data)
    {
        return $this->create($data);
    }

    public function updateAlat($data, $id)
    {
        $alat = $this->find($id);
        $alat->fill($data)->save();
        return $alat;
    }

    public function deleteAlat($id)
    {
        $alat = $this->find($id);
        $alat->delete();
        return $alat;
    }
}
