<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // return [
        //     //
        //     'name' => 'required',
        //     'photo' => 'image|mimes:jpeg,bmp,png|size:2000'
        // ];
        $rules = [
            'name' => 'required'
        ];
        // dd($this->file('photos'));
        // dd($photos);
        if ($this->file('photos')) {
            $photos = count($this->file('photos'));
            foreach(range(0, $photos) as $index) {
                $rules['photos.' . $index] = 'image|mimes:jpeg,bmp,png|max:2000';
            }
        }

        return $rules;
    }
}
