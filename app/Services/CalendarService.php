<?php

namespace App\Services;
use App\Models\phonghocs;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CalendarService{
    public function generateCalendarData($weekDays, $phongs){
        $calendarData = [];
        $timeRange = (new TimeService)
            ->generateTimeRange(config('app.calendar.start_time_sang'), config('app.calendar.end_time_sang'),config('app.calendar.start_time_chieu'), config('app.calendar.end_time_chieu'));
        // $rooms = phonghocs::with('class', 'giaovien', 'monhoc')->get();
        foreach($timeRange as $time){
            $timeText = $time['start']. ' - ' . $time['end'];
            $calendarData[$timeText] = [];
            foreach($weekDays as $i => $day){
                foreach($phongs as $phong){
                    $room = DB::table('phonghocs')
                    ->join('giohocs', 'phonghocs.maGH', '=' , 'giohocs.maGH')
                    ->join('giaoviens', 'phonghocs.maGV', '=' , 'giaoviens.maGV')
                    ->select('phonghocs.id','phonghocs.ngayhoc', 'giohocs.time_begin','giohocs.time_end', 'phonghocs.namePH', 'giaoviens.tenGV')
                    ->where('phonghocs.ngayhoc', $i)
                    ->where('phonghocs.namePH', $phong)
                    ->where('giohocs.time_begin', $time['start']) 
                    ->first();
                    $roomCount = DB::table('phonghocs')
                    ->join('giohocs', 'phonghocs.maGH', '=' , 'giohocs.maGH')
                    ->select('phonghocs.ngayhoc', 'giohocs.time_begin', 'giohocs.time_end')
                    ->where('phonghocs.ngayhoc', $i)
                    ->where('phonghocs.namePH', $phong)
                    ->where('giohocs.time_begin', '<=' ,$time['start'])
                    ->where('giohocs.time_end', '>=' ,$time['end']) 
                    ->count();
                    if ($room)
                    {
                        array_push($calendarData[$timeText], [
                            'id' => $room->id,
                            'class_name'   => $room->namePH,
                            'teacher_name' => $room->tenGV,
                            'rowspan'      => Carbon::parse($room->time_end)->diffInMinutes($room->time_begin)/50 ?? '',
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

    public function availableRoom($weekDays, $idRoom){
        $calendarData = [];
        $timeRange = (new TimeService)
            ->generateTimeRange(config('app.calendar.start_time_sang'), config('app.calendar.end_time_sang'),config('app.calendar.start_time_chieu'), config('app.calendar.end_time_chieu'));
        foreach($timeRange as $time){
            $timeText = $time['start']. ' - ' . $time['end'];
            $calendarData[$timeText] = [];

            foreach($weekDays as $i => $day){
                $room = DB::table('phonghocs')
                ->join('giohocs', 'phonghocs.maGH', '=' , 'giohocs.maGH')
                ->join('giaoviens', 'phonghocs.maGV', '=' , 'giaoviens.maGV')
                ->select('phonghocs.ngayhoc', 'giohocs.time_begin','giohocs.time_end', 'phonghocs.namePH', 'giaoviens.tenGV', 'phonghocs.id')
                ->where('phonghocs.ngayhoc', $i)
                ->where('phonghocs.namePH', $idRoom)
                ->where('giohocs.time_begin','<=' ,$time['start'])
                ->where('giohocs.time_end', '>=', $time['end'])
                ->first();
                // dd($room);
                $roomCount = DB::table('phonghocs')
                ->join('giohocs', 'phonghocs.maGH', '=' , 'giohocs.maGH')
                ->select('phonghocs.ngayhoc', 'giohocs.time_begin', 'giohocs.time_end', 'phonghocs.namePH')
                ->where('phonghocs.ngayhoc', $i)
                ->where('phonghocs.namePH', $idRoom)
                ->where('giohocs.time_begin','<=' ,$time['start'])
                ->where('giohocs.time_end', '>=' ,$time['end']) 
                ->get()
                ->count();
                // dd($time['start'], $time['end']);
                if ($room)
                {
                    array_push($calendarData[$timeText], [
                        'room' => [
                            'room'         => $room->namePH,
                            'teacher_name' => $room->tenGV,
                            'rowspan'      => Carbon::parse($room->time_end)->diffInMinutes($room->time_begin)/50 ?? '',
                            'time'         => $timeText,
                            'id'           => $room->id
                        ]
                    ]);
                }
                else if(!$roomCount){
                    array_push($calendarData[$timeText], [
                        'booking' => [
                            'idRoom' => $idRoom,
                            'time' => $timeText,
                            'day' => $day,
                            'idDay' => $i
                        ]
                    ]);
                }
            }
        }

        return $calendarData;
    }


    public function getTimecalendar(){
        $calendarData = [];
        $tiet = 1;
        $timeRange = (new TimeService)->generateTimeRange(config('app.calendar.start_time_sang'), config('app.calendar.end_time_sang'),config('app.calendar.start_time_chieu'), config('app.calendar.end_time_chieu'));
        foreach($timeRange as $time){
            $timeText = $time['start']. ' - ' . $time['end'];
            $calendarData[$tiet] = [$timeText];
            $tiet++;
        }
        return $calendarData;
        
    }
}
