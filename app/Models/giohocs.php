<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class giohocs extends Model
{
    use HasFactory;
    protected $table = 'giohocs';
    protected $fillable = ['maGH', 'time_begin', 'time_end'];


    protected $primaryKey = 'maGH';
    
}
