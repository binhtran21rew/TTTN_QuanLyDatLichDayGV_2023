<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\giaoviens;
use App\Models\monhocs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    private $giaovien;
    private $monhoc;
    function __construct(giaoviens $giaovien, monhocs $monhoc){
        $this->giaovien = $giaovien;
        $this->monhoc = $monhoc;
    }
    public function index(){
        $teachers = DB::table('giaoviens')
        ->select('giaoviens.*')
        ->get();
        return view('pages.teacher.viewTeacher', compact('teachers'));

    }

    public function viewAddTeacher(){
        return view('pages.teacher.addTeacher');
    }
    public function createTeacher(TeacherRequest $req){
        $isTeacher = $this->giaovien::where('maGV', $req->magiaovien)->get()->count();
        if($isTeacher > 0){
            $messages = 'Mã giáo viên đã có';
            return view('pages.teacher.addTeacher', compact('messages'));
        }else{
            $this->giaovien->create([
                'maGV' => $req->magiaovien,
                'tenGV' => $req->tengiaovien,
                'maMH' => $req->maMH,
            ]);
            $messages = "Tạo thành công";
            return view('pages.teacher.addTeacher', compact('messages'));
        }


    }
  
}