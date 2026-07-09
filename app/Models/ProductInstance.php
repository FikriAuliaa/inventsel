<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInstance extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'kode_unik',
        'status_ketersediaan',
        'kondisi_barang',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function borrowingDetails()
    {
        return $this->hasMany(BorrowingDetail::class);
    }
}