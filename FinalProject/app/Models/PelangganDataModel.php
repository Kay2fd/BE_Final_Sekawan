<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganDataModel extends Model
{
    protected $table = 'pelanggan_data';
    protected $primaryKey = 'pelanggandata_id';
    protected $fillable = [
        'pelanggandata_nama',
        'pelanggandata_alamat',
        'pelanggandata_jenis',
    ];

    public function getAllpelanggandata()
    {
        return $this->all();
    }
    public function createpelanggandata($data)
    {
        return $this->create($data);
    }

    public function update_pelanggandata($data, $id)
    {
        $pelanggandata = self::find($id);
        $pelanggandata->fill($data);
        $pelanggandata->save();
        return $pelanggandata;
    }
    public function delete_pelanggandata($id)
    {
        $pelanggandata = self::find($id);
        if ($pelanggandata) {
            $pelanggandata->delete();
        }
        return $pelanggandata;
    }
}
