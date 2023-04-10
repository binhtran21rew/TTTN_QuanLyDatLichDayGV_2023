<?php
namespace App\Services;

use App\Models\giohocs;
use App\Models\phonghocs;
use Carbon\Carbon;
// use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ComponentAddRoom{
    private $time;
    private $room;
    function __construct(giohocs $time, phonghocs $room){
        $this->time = $time;
        $this->room = $room;
    }
    public function roomBooking($timeBegin, $timeEnd, $id, $time, $day, $idTeacher, $idClass, $idCourse){
        
        // kiem tra khung thoi gian ton tai
        $getTime = DB::table('giohocs')->where('time_begin', $timeBegin)
        ->where('time_end',$timeEnd)
        ->orWhere('time_begin', $timeBegin)
        ->where('time_end',Carbon::parse($timeEnd)->addMinutes(5))
        ->get();
        if(sizeof($getTime) > 0){
            $idTime = $getTime[0]->maGH;
            
            // kiem tra phong hoc da co
            $checkroom = DB::table('phonghocs')
            ->join('giohocs', 'phonghocs.maGH','=','giohocs.maGH')
            ->where('phonghocs.namePH', $id)
            ->where('phonghocs.ngayhoc', $day)
            ->where('giohocs.time_begin', '<=', $timeBegin)
            ->where('giohocs.time_end', '>=', $timeBegin)
    
            ->orWhere('phonghocs.namePH', $id)
            ->where('phonghocs.ngayhoc', $day)
            ->where('giohocs.time_begin', '<=', $timeEnd)
            ->where('giohocs.time_end', '>=', $timeEnd)

            ->orwhere('phonghocs.namePH', $id)
            ->where('phonghocs.ngayhoc', $day)
            ->where('giohocs.time_begin', '<=', $timeEnd)
            ->where('giohocs.time_end', '>=', $timeBegin)
            ->get()
            ->count();

            // kiem tra giao vien co dang day
            $checkTeacherInRoom = DB::table('phonghocs')
            ->join('giohocs', 'phonghocs.maGH','=','giohocs.maGH')
            ->where('phonghocs.maGV', $idTeacher)
            ->where('phonghocs.ngayhoc', $day)
            ->where('giohocs.time_begin', '<=', $timeBegin)
            ->where('giohocs.time_end', '>=', $timeBegin)

            ->orWhere('phonghocs.maGV', $idTeacher)
            ->where('phonghocs.ngayhoc', $day)
            ->where('giohocs.time_begin', '<=', $timeEnd)
            ->where('giohocs.time_end', '>=', $timeEnd)

            ->orWhere('phonghocs.maGV', $idTeacher)
            ->where('phonghocs.ngayhoc', $day)
            ->where('giohocs.time_begin', '<=', $timeEnd)
            ->where('giohocs.time_end', '>=', $timeBegin)
            ->get()
            ->count();

            // kiem tra lop hoc dang hoc
            $checkClassInRoom = DB::table('phonghocs')
            ->join('giohocs', 'phonghocs.maGH','=','giohocs.maGH')
            ->where('phonghocs.maLop', $idClass)
            ->where('phonghocs.ngayhoc', $day)
            ->where('giohocs.time_begin', '<=', $timeBegin)
            ->where('giohocs.time_end', '>=', $timeBegin)

            ->orwhere('phonghocs.maLop', $idClass)
            ->where('phonghocs.ngayhoc', $day)
            ->where('giohocs.time_begin', '<=', $timeEnd)
            ->where('giohocs.time_end', '>=', $timeEnd)

            ->orwhere('phonghocs.maLop', $idClass)
            ->where('phonghocs.ngayhoc', $day)
            ->where('giohocs.time_begin', '<=', $timeEnd)
            ->where('giohocs.time_end', '>=', $timeBegin)
            ->get()
            ->count();
        }
        // dd($id,$timeBegin, $timeEnd,$checkroom );
       

        if(sizeof($getTime) > 0){
            switch(true){
                case $checkroom > 0:
                    $messages = 'Trong khung giờ học đã có phòng đang học';
                    break;
                case $checkTeacherInRoom > 0:
                    $messages = 'Đã có giáo viên dạy trong phòng khác';
                    break;
                case $checkClassInRoom > 0:
                    $messages = 'Đã có lớp đang học ở phòng khác';
                    break;
                default:
                    $this->room->create([
                        'namePH' => $id,
                        'maMH' => $idCourse,
                        'maGV' => $idTeacher,
                        'maLop' => $idClass,
                        'maGH' => $idTime,
                        'ngayhoc' => $day,
                        'tinhtrang' => 1
                    ]);
                    $messages = 'Đặt phòng học thành công';
                    break;
            }
            return $messages;
        }else{
            $messages = 'Khung thời gian không tồn tại trong lịch học';
            return $messages;
        }
    }
}
