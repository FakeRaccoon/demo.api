<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;

    protected $casts = ['confirmed' => 'boolean', 'form_id' => 'integer', ];

    protected $fillable = [
        'name', 'form_id', 'task', 'depart', 'return', 'confirmed', 'user_id', 'item_id'
    ];
    protected $table = 'technician';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->hasMany(Item::class, 'form_id', 'form_id');
    }
}
