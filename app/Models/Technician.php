<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;

    protected $casts = ['confirmed' => 'boolean'];

    protected $fillable = [
        'name', 'form_id', 'task', 'depart', 'return', 'confirmed', 'warehouse'
    ];
    protected $table = 'technician';
}
