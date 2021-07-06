<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvencePay extends Model
{
    use HasFactory;


    protected $table = 'advancepay';

    public $timestamps = true;

    protected $fillable = [
        'advance_pay',
        'advance_date',
        '_token'
    ];



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

        'updated_at' => 'timestamps',
        'created_at' => 'timestamps',

    ];

}
