<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriStock extends Model
{
    use HasFactory;


    protected $table = 'primaryproduct';

    public $timestamps = true;


    protected $fillable = [
        'code',
        'productname',
        'quantity',
        'unit',
        '_csrf',
    ];


}
