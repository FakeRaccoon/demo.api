<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'districts';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'city_id',
        'name'
    ];

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

}
