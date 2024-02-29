<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin'; 

    protected $primaryKey = 'admin_id'; 

    protected $fillable = [
        'admin_username',
        'admin_password',
    ];

    public function setAdminPasswordAttribute($value)
    {
        $this->attributes['admin_password'] = Hash::make($value);
    }
}
