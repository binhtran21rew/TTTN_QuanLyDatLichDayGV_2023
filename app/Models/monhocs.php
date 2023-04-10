<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monhocs extends Model
{
    use HasFactory;
    protected $table = 'monhocs';
    protected $fillable = ['maMH', 'tenMH', 'time_hoc', 'time_end'];

    const WEEK_DAYS = [
            '2' => 'Monday',
            '3' => 'Tuesday',
            '4' => 'Wednesday',
            '5' => 'Thursday',
            '6' => 'Friday',
            '7' => 'Saturday',
            '8' => 'Sunday',
    ];

    const ROOM = [
            'PM1' => 'PM1',
            'PM2' => 'PM2',
            'PM3' => 'PM3',
            'PM4' => 'PM4',
            'PM5' => 'PM5',
            'PM6' => 'PM6',
            'PM7' => 'PM7',
            'PM8' => 'PM8',
            'PM9' => 'PM9',
    ];
    protected $primaryKey = 'maMH';

}
