<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = 'form';

    protected $fillable = [
        // 'province_id',
        // 'city_id',
        // 'district_id',
        // 'item_id',
        // 'item',
        // 'item_measure_id',
        'user_id',
        'status',
        'type',
        // 'fee',
        // 'fee_desc',
        // 'warehouse',
        // 'warehouse_destination',
        // 'image',
        // 'code_image',
        // 'return_image',
        'vehicle',
        'reject_reason',
        'estimated_date',
        'departure_date',
        'return_date',
        'destination',
    ];

    protected $casts = ["item_id" => "integer", 'warehouse_id' => 'integer', 'item_measure_id' => 'integer'];

    public function items()
    {
        return $this->hasMany('App\Models\Item', 'form_id');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function driver()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function fee()
    {
        return $this->hasMany('App\Models\Fee');
    }

    public function technician()
    {
        return $this->hasMany('App\Models\Technician');
    }

    public function transport()
    {
        return $this->belongsTo('App\Models\Transportation');
    }

    public function type()
    {
        switch ($this->type) {
            case '1':
                $type = 'Display';
                break;
            case '2':
                $type = 'Tes Mesin';
                break;
            default:
                $type = 'Invalid';
                break;
        }

        return $type;
    }

    public function status()
    {
        switch ($this->status) {
            case '1':
                $status = 'Pending';
                break;
            case '2':
                $status = 'Approve 1';
                break;
            case '3':
                $status = 'Reject';
                break;
            case '4':
                $status = 'Approve Kepala Teknisi';
                break;
            case '5':
                $status = 'Approve 2';
                break;
            case '6':
                $status = 'Dalam Perjalanan';
                break;
            case '7':
                $status = 'Returned';
                break;
            default:
                $status = 'Invalid';
                break;
        }

        return $status;
    }
}
