<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id', 'item_id', 'item_name', 'item_measure_id', 'demo_type', 'warehouse_id', 'warehouse'
    ];

    protected $casts = [
        'form_id' => 'integer', 'item_id' => 'integer', 'item_measure_id' => 'integer', 'warehouse_id' => 'integer', 'demo_type' => 'integer'
    ];
}
