<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harvest extends Model
{
    use HasFactory;

    /**
     * @var string[] The attributes that are mass assignable.
     */
    protected $fillable = [
        'uuid',
        'state',
        'strain',
        'quantity',
        'unit',
        'weight',
    ];
}
