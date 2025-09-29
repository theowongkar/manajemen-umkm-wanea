<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    /** @use HasFactory<\Database\Factories\BusinessFactory> */
    use HasFactory;

    protected $fillable = [
        'urban_village_id',
        'product_name',
        'owner_name',
        'owner_phone',
        'address',
        'status',
    ];

    // Relasi: UMKM milik satu kelurahan (One To Many)
    public function urbanVillage()
    {
        return $this->belongsTo(UrbanVillage::class);
    }
}
