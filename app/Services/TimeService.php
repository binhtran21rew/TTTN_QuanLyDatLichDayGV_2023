<?php
namespace App\Services;

use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Carbon;
 
class TimeService {
    public function generateTimeRange($fromsang, $tosang, $fromchieu, $tochieu) {
        $timesang = Carbon::parse($fromsang);
        $timechieu = Carbon::parse($fromchieu);
        $timeRange = [];
        $i=0;
        do{
            if($timeRange == null){
                array_push($timeRange, [
                    'start' => $timesang->format("H:i"),
                    'end' => $timesang->addMinute(50)->format("H:i")
                ]);
            }else{
                if(sizeof($timeRange) > 2 && Carbon::parse($timeRange[$i]['end']) == Carbon::parse($timeRange[$i-2]['start'])->addHour(2)->addMinute(30)){
                    $timesang = Carbon::parse($timesang)->addMinute(5);
                    array_push($timeRange, [
                        'start' => $timesang->format("H:i"),
                        'end' => $timesang->addMinute(50)->format("H:i")
                    ]);
                }else{
                    array_push($timeRange, [
                        'start' => $timesang->format("H:i"),
                        'end' => $timesang->addMinute(50)->format("H:i")
                    ]);
                }
                $i++;
            }


        }while($timesang->format("H:i") !== $tosang);
        do{
            if(sizeof($timeRange) > 8 && Carbon::parse($timeRange[$i]['end']) == Carbon::parse($timeRange[$i -2]['start'])->addHour(2)->addMinute(30)){
                $timechieu = Carbon::parse($timechieu)->addMinute(5);
                array_push($timeRange, [
                    'start' => $timechieu->format("H:i"),
                    'end' => $timechieu->addMinute(50)->format("H:i")
                ]);
            }else{
                array_push($timeRange, [
                    'start' => $timechieu->format("H:i"),
                    'end' => $timechieu->addMinute(50)->format("H:i")
                ]);
            }
            $i++;
            
        }while($timechieu->format("H:i") !== $tochieu);
        return $timeRange;
    }
}
