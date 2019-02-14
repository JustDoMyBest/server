<?php

namespace App\Traits;

trait ConvertUtils {
    public function ConvertEnabledToBoolean($str){
        // if ($request['enabled'] === '1') {
        if ($str === '1') {
            // $enabled = true;
            return true;
        }else {
            // $enabled = false;
            return false;
        } 
    }
}