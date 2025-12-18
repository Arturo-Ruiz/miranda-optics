<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stock',
        'price'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer'
    ];

    public function getStockColorClass()
    {
        if ($this->stock < 10) {
            return 'bg-red-100 text-red-800';
        } elseif ($this->stock < 20) {
            return 'bg-yellow-100 text-yellow-800';
        } else {
            return 'bg-green-100 text-green-800';
        }
    }
}
