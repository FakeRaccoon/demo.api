<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'notification';

    protected $casts = ['read' => 'boolean'];

    protected $fillable = ["user_id", "title", "content", "read"];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
