<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'kategori_id';
    protected $fillable = ['kategori_nama'];
    public function getAllKategori()
    {
        return $this->all();
    }
    public function createKategori($data)
    {
        return $this->create($data);
    }
    public function update_kategori($data, $id)
    {
        $kategori = self::find($id);
        $kategori->fill($data);
        $kategori->save();
        return $kategori;
    }
    public function delete_kategori($id)
    {
        $kategori = self::find($id);
        if ($kategori) {
            $kategori->delete();
        }
        return $kategori;
    }
}
