<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookiesCheck extends Model
{
    use HasFactory;

    protected $table = 'cookies_check';
    public $timestamps = false;

    public $fillable = ['clicked'];
}
