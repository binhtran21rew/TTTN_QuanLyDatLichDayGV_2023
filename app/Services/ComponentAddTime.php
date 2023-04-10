<?php
namespace App\Services;

use App\Models\giohocs;
use Carbon\Carbon;

class ComponentAddTime{
    public function addTime($id_time, $time_begin, $time_end, $isvalidtime, $hour, $minute, $string, $nTiet){
        if($isvalidtime){
            if(Carbon::parse($time_end) == Carbon::parse($time_begin)->addHour($hour)->addMinute($minute) || Carbon::parse($time_end) == Carbon::parse($time_begin)->addHour( $hour)->addMinute($minute+5)){
                if($time_end <= '17:40'){
                    $isTime = giohocs::where('maGH', $string)
                    ->orwhere('time_begin',$time_begin)
                    ->where('time_end',$time_end)
                    ->get()
                    ->count();
                    if($isTime > 0){
                        $messages = 'Trùng mã giờ học';
                        return $messages;
                    }else{
                        giohocs::create([
                            'maGH' => $string,
                            'time_begin' => Carbon::parse($time_begin)->format('H:i:s'),
                            'time_end' => Carbon::parse($time_end)->format('H:i:s')
                        ]);
                        $messages = 'Tạo thành công';
                        return $messages;

                    }
                } else{
                    $messages = 'Thời gian học không trễ 17h40p || 5h:40PM';
                    return $messages;
                }
            }else{
                $messages = $nTiet;
                return $messages;
            }
            
        }else{
            $messages = 'Các tiết học phải liền nhau';
            return $messages;
        }
    } 
}
