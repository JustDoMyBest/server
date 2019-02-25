<?php

namespace App\Traits;

trait ConvertUtils {
    public function convertEnabledToBoolean($str) {
        // if ($request['enabled'] === '1') {
        if ($str === '1' || $str === 'on') {
            // $enabled = true;
            return true;
        }else {
            // $enabled = false;
            return false;
        } 
    }

    public function convertTagsArrayToString($tags) {
        $str = '';
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                if (!empty($tag)) {
                    $str .= $tag . ',';
                }
            }
            $str = substr($str, 0, strlen($str)-1);
        }
        return $str;
    }

    public function convertTagsStringToArray($tags) {
        // $arr = array();
        // $arr = explode(',', $tags);
        return explode(',', $tags);
    }
}