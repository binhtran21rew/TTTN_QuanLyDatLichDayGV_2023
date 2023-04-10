<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\giaoviens;
use App\Models\giohocs;
use App\Models\lophocs;
use App\Models\monhocs;
use App\Models\phonghocs;
use App\Services\CalendarService;
use App\Services\ComponentAddRoom;
use App\Services\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomsController extends Controller
{
    private $phonghoc;
    private $calendarService;
    private $courses;
    private $teacher;
    private $class;
    private $util;
    private $time;
    private $componentAddRoom;
    public function __construct(phonghocs $phonghoc, CalendarService $calendarService, monhocs $monhoc, giaoviens $giaovien, lophocs $lop, Util $util, giohocs $giohoc, ComponentAddRoom $componentAddRoom){
        $this->phonghoc = $phonghoc;
        $this->calendarService = $calendarService;
        $this->courses = $monhoc;
        $this->teacher = $giaovien;
        $this->class = $lop;
        $this->util = $util;
        $this->time = $giohoc;
        $this->componentAddRoom = $componentAddRoom;
    }
    public function index(){
        $weekDays =  monhocs::WEEK_DAYS;
        $rooms = monhocs::ROOM;

        return view('pages.rooms.viewRooms', compact('rooms', 'weekDays'));
    } 

    public function show_available($id){
        $weekDays = monhocs::WEEK_DAYS;
        $rooms = monhocs::ROOM;

        $calendarData = $this->calendarService->availableRoom($weekDays, $id);

        return view('pages.rooms.roomsAvilable', compact('rooms', 'calendarData', 'weekDays'));
    }
    public function viewAddPhonghoc($id, $time, $day, $idDay){
        $courses = DB::table('monhocs')->get();

        $teachers = DB::table('giaoviens')->get();
        $classes = DB::table('lophocs')->get();
        return view('pages.rooms.addPhonghoc', compact('id', 'time', 'day', 'idDay', 'courses', 'teachers', 'classes'));
    }


    public function createRoom( $id, $time, $day, RoomRequest $req){
        $s = $this->util->cutTimeBegin($time);
        $idDay = $day;
        $courses = DB::table('monhocs')->get();

        $teachers = DB::table('giaoviens')->get();
        $classes = DB::table('lophocs')->get();
        switch($req->idTime){
            case 3:
                $timeBegin = Carbon::parse($s);
                $timeEnd = Carbon::parse($s)->addHour(2)->addMinute(30);
                $messages = $this->componentAddRoom->roomBooking($timeBegin, $timeEnd,  $id, $time, $day, $req->idTeacher, $req->idClass, $req->idCourse);
                return view('pages.rooms.addPhonghoc', compact('messages','id', 'time', 'day', 'idDay', 'courses', 'teachers', 'classes'));
                break;
            case 4:
                $timeBegin = Carbon::parse($s);
                $timeEnd = Carbon::parse($s)->addHour(3)->addMinute(25);
                $messages = $this->componentAddRoom->roomBooking($timeBegin, $timeEnd,  $id, $time, $day, $req->idTeacher, $req->idClass, $req->idCourse);
                return view('pages.rooms.addPhonghoc', compact('messages','id', 'time', 'day', 'idDay', 'courses', 'teachers', 'classes'));

                break;
            case 5:
                $timeBegin = Carbon::parse($s);
                $timeEnd = Carbon::parse($s)->addHour(4)->addMinute(15);
                $messages = $this->componentAddRoom->roomBooking($timeBegin, $timeEnd,  $id, $time, $day, $req->idTeacher, $req->idClass, $req->idCourse);
                return view('pages.rooms.addPhonghoc', compact('messages','id', 'time', 'day', 'idDay', 'courses', 'teachers', 'classes'));
                break;
        }

    }


    public function infoRoom($id){
        $infoRoom = DB::table('phonghocs')
        ->join('monhocs', 'phonghocs.maMH', '=', 'monhocs.maMH')
        ->join('giaoviens', 'phonghocs.maGV', '=', 'giaoviens.maGV')
        ->join('giohocs', 'phonghocs.maGH', '=', 'giohocs.maGH')
        ->select('phonghocs.*', 'monhocs.tenMH as nameMH', 'giaoviens.tenGV as nameGV', 'giohocs.time_begin as time_begin', 'giohocs.time_end as time_end')
        ->where('phonghocs.id', $id)
        ->get();
        return view('pages.rooms.infoRoom', compact('infoRoom'));
    }
}
