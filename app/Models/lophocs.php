<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lophocs extends Model
{
    use HasFactory;
    protected $table = 'lophocs';
    protected $fillable = ['maLop', 'siso'];

    protected $primaryKey = 'maLop';

}
