<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'kode_barang',
        'nama_barang',
        'stok',
        'lokasi_penyimpanan',
        'kondisi_barang',
        'gambar',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function instances()
    {
        return $this->hasMany(ProductInstance::class);
    }
}