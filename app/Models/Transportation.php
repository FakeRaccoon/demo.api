<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 'plat_no', 'image', 'idle', 'kilometer'
    ];
    protected $table = 'transport';

    protected $casts = ['idle' => 'boolean', 'kilometer' => 'integer'];

    public function history()
    {
        return $this->hasMany(TransportHistory::class, 'transport_id');
    }
}
