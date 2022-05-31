<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbFlag extends Model
{
    use HasFactory;

    protected $table = 'ab_flag';
    public $timestamps = false;
}
