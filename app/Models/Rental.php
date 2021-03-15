<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Transport\Transport;

class Rental extends Model
{
    use HasFactory;

    protected $table      = 'rental';

    protected $fillable = [
        'transport_id', 'driver_id', 'description', 'rental_date', 'return_date'
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function transport()
    {
        return $this->belongsTo(Transportation::class, 'transport_id');
    }
}
