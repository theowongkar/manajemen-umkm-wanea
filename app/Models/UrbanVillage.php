<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrbanVillage extends Model
{
    /** @use HasFactory<\Database\Factories\UrbanVillageFactory> */
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'slug',
    ];

    // Generate Slug
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    // Relasi: 1 kelurahan memiliki banyak UMKM (One To Many)
    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
