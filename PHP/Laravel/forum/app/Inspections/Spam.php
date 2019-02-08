<?php

namespace App\Inspections;

class Spam
{
    public function detect($body)
    {
        $this->detectInvalidKeywords($body);

        return false;
        // return true;
    }

    public function detectInvalidKeywords($body)
    {
        $invalidKeywords = [
            'something forbidden'
        ];

        foreach ($invalidKeywords as $invalidKeyword){
            if(stripos($body,$invalidKeyword) !== false){
                throw new \Exception('Your reply contains spam.');
                // throw new \Illuminate\Validation\ValidationException('Your reply contains spam.');
            }
        }

    }
}