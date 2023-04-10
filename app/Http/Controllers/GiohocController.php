<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeRequest;
use App\Models\giohocs;
use App\Services\CalendarService;
use App\Services\ComponentAddTime;
use App\Services\SortString;
use App\Services\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GiohocController extends Controller
{
    private $giohoc;
    private $calendar;
    private $util;
    private $componentAddTime;
    function __construct(giohocs $giohoc, CalendarService $calendar, Util $util, ComponentAddTime $componentAddTime){
        $this->giohoc=$giohoc;
        $this->calendar= $calendar;
        $this->util=$util;
        $this->componentAddTime = $componentAddTime;
    }
    public function index(){
        // $times = $this->giohoc::all();
        $times = DB::table('giohocs')
        ->get();
        return view('pages.giohoc.viewGiohoc', compact('times'));
        
    }
    public function viewAddGiohoc(){
        $calendarData = $this->calendar->getTimecalendar();
        return view('pages.giohoc.addGiohoc' , compact('calendarData'));
    }
    public function createTime(TimeRequest $req){
        $calendarData = $this->calendar->getTimecalendar();

        $string = $this->util->sort($req->time);
        $isvalidtime = $this->util->checkTimeFormat($req->time);

        if($string[strlen($string)-1] == 9 && $string[0] == 0){
            $number = $req->time;
        }else{
            $number = $string;
        }
        // dd($string, $number, $isvalidtime);

        switch(strlen($req->time)){
            case 3:
                $messages = $this->componentAddTime->addTime($req->time, $req->time_begin, $req->time_end, $isvalidtime, 2, 30, $string, $nTiet='3 ca học phải đủ 2h30p');
                return view('pages.giohoc.addGiohoc', compact('messages','calendarData'));
                break;
            case 4:
                $messages = $this->componentAddTime->addTime($req->time, $req->time_begin, $req->time_end, $isvalidtime, 3, 25, $string, $nTiet='4 ca học phải đủ 3h25p');
                return view('pages.giohoc.addGiohoc', compact('messages','calendarData'));
                break;
            case 5:
                $messages = $this->componentAddTime->addTime($req->time, $req->time_begin, $req->time_end, $isvalidtime, 4, 15, $string, $nTiet='5 ca học phải đủ 4h15p');
                return view('pages.giohoc.addGiohoc', compact('messages','calendarData'));
                break;
            default:
                $messages = 'Ca học phải ít nhất 3 ca và nhiều nhất 5 ca';
                return view('pages.giohoc.addGiohoc', compact('messages' ,'calendarData'));

        }

    }
}