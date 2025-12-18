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
            return 'text-red-600 font-semibold';
        } elseif ($this->stock < 20) {
            return 'text-yellow-600 font-semibold';
        } else {
            return 'text-green-600 font-semibold';
        }
    }
}
