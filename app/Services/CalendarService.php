<?php

namespace App\Services;
use App\Models\phonghocs;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CalendarService{
    public function generateCalendarData($weekDays, $phongs){
        $calendarData = [];
        $timeRange = (new TimeService)
            ->generateTimeRange(config('app.calendar.start_time'), config('app.calendar.end_time'));
        // $rooms = phonghocs::with('class', 'giaovien', 'monhoc')->get();
        foreach($timeRange as $time){
            $timeText = $time['start']. ' - ' . $time['end'];
            $calendarData[$timeText] = [];
            foreach($weekDays as $i => $day){
                foreach($phongs as $phong){
                    $room = DB::table('phonghocs')
                    ->join('monhocs', 'monhocs.maMH', '=' ,'phonghocs.maMH')
                    ->join('giohocs', 'monhocs.maGH', '=' , 'giohocs.maGH')
                    ->join('giaoviens', 'phonghocs.maGV', '=' , 'giaoviens.maGV')
                    ->select('monhocs.ngayhoc', 'giohocs.time_begin','giohocs.time_end', 'phonghocs.namePH', 'giaoviens.tenGV')
                    ->where('monhocs.ngayhoc', $i)
                    ->where('phonghocs.namePH', $phong)
                    ->where('giohocs.time_begin', $time['start']) 
                    ->first();
                    $roomCount = DB::table('monhocs')
                    ->join('phonghocs', 'monhocs.maMH', '=' ,'phonghocs.maMH')
                    ->join('giohocs', 'monhocs.maGH', '=' , 'giohocs.maGH')
                    ->select('monhocs.ngayhoc', 'giohocs.time_begin', 'giohocs.time_end')
                    ->where('monhocs.ngayhoc', $i)
                    ->where('giohocs.time_begin', '<' ,$time['start'])
                    ->where('giohocs.time_end', '>=' ,$time['end']) 
                    ->count();
                    if ($room)
                    {
                        array_push($calendarData[$timeText], [
                            'class_name'   => $room->namePH,
                            'teacher_name' => $room->tenGV,
                            'rowspan'      => Carbon::parse($room->time_end)->diffInMinutes($room->time_begin)/30 ?? '',
                        ]);
                    }
                    else if(!$roomCount){
                        array_push($calendarData[$timeText], 1);
                    }else{
                        array_push($calendarData[$timeText], 0);
                    }
                }
                
            }
            
        }
        return $calendarData;
    }
}