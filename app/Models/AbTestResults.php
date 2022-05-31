<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbTestResults extends Model
{
    use HasFactory;

    protected $table = 'ab_test_results';
    public $timestamps = false;
}
