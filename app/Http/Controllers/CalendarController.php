<?php

namespace App\Http\Controllers;

use App\Models\monhocs;
use App\Services\CalendarService;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(CalendarService $calendarService){
        $weekDays = monhocs::WEEK_DAYS;
        $rooms = monhocs::ROOM;
        $calendarData = $calendarService->generateCalendarData($weekDays, $rooms);

        return view('calendar', compact('weekDays','rooms', 'calendarData'));
    }
}
