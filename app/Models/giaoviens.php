<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class giaoviens extends Model
{
    use HasFactory;
    protected $table= 'giaoviens';
    protected $fillable = ['maGV', 'tenGV'];
    protected $primaryKey = 'maGV';
}
