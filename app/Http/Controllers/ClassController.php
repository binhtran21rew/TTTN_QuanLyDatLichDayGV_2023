<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassesRequest;
use App\Models\lophocs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    private $class;
    function __construct(lophocs $class){
        $this->class = $class;
    }
    public function index(){
        $classes = DB::table('lophocs')->get();
        return view('pages.class.viewClass', compact('classes'));
    }
    public function viewaddClass(){
        return view('pages.class.addClass');
    }

    public function createClasses(ClassesRequest $req){
        $isClass = $this->class::where('maLop', $req->maclass)->first();
        if($isClass){
            $messages = 'Đã có mã lớp học';
            return view('pages.class.addClass', compact('messages'));
        }else{
            $this->class->create([
                'maLop' => $req->maclass,
                'siso' => $req->siso ? $req->siso : 0
            ]);
            $messages = 'Tạo thành công';
            return view('pages.class.addClass', compact('messages'));
        }
    }
}