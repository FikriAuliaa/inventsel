<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrowing_id',
        'product_instance_id',
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }

    public function productInstance()
    {
        return $this->belongsTo(ProductInstance::class);
    }
}