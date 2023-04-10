<?php

namespace App\Services;

use Carbon\Carbon;

class Util{
    public function sort($str){
        $mang = str_split($str, 1);
        sort($mang);
        $string = '';
        foreach($mang as $a){
            $string .= $a;
        }
        return $string;
    }
    public function checkContinual($str, $n){
        $mang = str_split($str, 1);
        sort($mang);
        $flag = 0 ;
        for($i=1;$i<=sizeof($mang)-1;$i++){
            if($mang[$i] == $mang[$i-1]+1){
                $flag++;
                if($flag == $n){
                    return true;
                }
            }
        }
        return false;
    }
    public function checkTimeFormat($str){
        $num = $this->sort($str);
        // dd(strlen($num ) == 4, $num [strlen($num )-1]== 9, $num [0] == 0, $str) ;
        switch(true){
            case strlen($num ) == 3 && $num [strlen($num )-1] == 9 && $num [0] == 0:
                $isvalid = $this->checkContinual($str, 1);
                if($isvalid) return true;
                return false;
                break;
            case strlen($num ) == 4 && $num [strlen($num )-1] == 9 && $num [0] == 0:
                $isvalid = $this->checkContinual( $str, 2);
                if($isvalid) return true;
                return false;
                break;
            case strlen($num ) == 5 && $num [strlen($num )-1] == 9 && $num [0] == 0:
                $isvalid = $this->checkContinual( $str, 3);
                if($isvalid) return true;
                return false;
                break;
            case strlen($num ) == 3:
                $isvalid = $this->checkContinual( $str, 2);
                if($isvalid) return true;
                return false;

                break;
            case strlen($num ) == 4:
                $isvalid = $this->checkContinual( $str, 3);
                if($isvalid) return true;
                return false;
                break;
            case strlen($num ) == 5:
                $isvalid = $this->checkContinual( $str, 4);
                if($isvalid) return true;
                return false;
                break;
            default:
                return false;
        }
    }


    public function cutTimeBegin($string){
        $time = explode(" ", $string);
        return $time[0]; 
    }
}
