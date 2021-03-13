<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportHistory extends Model
{
    use HasFactory;

    protected $table = 'transport_history';

    // protected $casts = ['driver_id' => 'array'];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
