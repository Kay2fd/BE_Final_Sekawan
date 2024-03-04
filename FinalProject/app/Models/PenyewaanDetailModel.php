<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyewaanDetailModel extends Model
{
   protected $table = 'penyewaan_detail';
   protected $primaryKey = 'penyewaan_detail_id';
   protected $fillable = [
    'penyewaan_detail_penyewaan_id',
    'penyewaan_detail_alat_id',
    'penyewaan_detail_jumlah',
    'penyewaan_detail_subharga',

   ];

   public function getAllPenyewaanDetail()
   {
    return $this->all();
   }
   public function findPenyewaanDetail($id)
   {
    return $this->find($id);
   }
   public function updatePenyewaanDetail($data, $id)
   {
    $penyewaanDetail = $this->find($id);
    $penyewaanDetail->fill($data);
    $penyewaanDetail->save();

    return $penyewaanDetail;
   }
   public function deletePenyewaanDetail($id)
   {
    $penyewaanDetail = $this->find($id);
    if($penyewaanDetail) {
        $penyewaanDetail->delete();
    }
    return $penyewaanDetail;
   }
}
