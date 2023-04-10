<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phonghocs extends Model
{
    use HasFactory;
    protected $table = 'phonghocs';
    protected $fillable = ['namePH', 'maMH', 'maGV', 'maLop','maGH','ngayhoc', 'tinhtrang'];

}
