<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoursesRequest;
use App\Models\monhocs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonhocController extends Controller
{
    private $monhoc;
    function __construct(monhocs $monhoc){
        $this->monhoc = $monhoc;
    }
    public function index(){
        $courses = DB::table('monhocs')->get();
        return view('pages.monhoc.viewMonhoc', compact('courses'));
        
    }
    public function viewAddMonhoc(){
        return view('pages.monhoc.addMonhoc');
    }

    public function createCourses(CoursesRequest $req){
        $course = $this->monhoc::where('maMH', $req->idcourse)->orWhere('tenMH', $req->namecourse)->first();

        if($course){
            $messages = "Đã có môn học";
            return view('pages.monhoc.addMonhoc', compact('messages'));
        }else{
            $this->monhoc->create([
                'maMH' => $req->idcourse,
                'tenMH' => $req->namecourse,
                'time_hoc' => Carbon::parse($req->timebegin)->format('Y-m-d'), 
                'time_end' => Carbon::parse($req->timeend)->format('Y-m-d'),    

            ]);
            $messages = "Tạo thành công";
            return view('pages.monhoc.addMonhoc', compact('messages'));
        }
    }
}
