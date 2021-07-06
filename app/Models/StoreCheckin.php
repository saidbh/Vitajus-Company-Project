<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCheckin extends Model
{
    use HasFactory;

    protected $table = 'checkin';

    protected $fillable = [
        'id_worker',
        'date_checkin',
        'status'
    ];

}
