<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreWorkers extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'workers';
    public $timestamps = true;

    protected $fillable = [

        'name',
        'family_name',
        'address',
        'phone',
        'enter_date',
        'salary',
        '_token',
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
