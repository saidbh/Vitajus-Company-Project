<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditStore extends Model
{
    use HasFactory;
    protected $table = 'workers';

    protected $fillable = [
        'name',
        'family_name',
        'address',
        'phone',
        'enter_date',
    ];
}
