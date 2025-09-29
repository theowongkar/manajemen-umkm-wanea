<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrbanVillage extends Model
{
    /** @use HasFactory<\Database\Factories\UrbanVillageFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    // Relasi: 1 kelurahan memiliki banyak UMKM (One To Many)
    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
