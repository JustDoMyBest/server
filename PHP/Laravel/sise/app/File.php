<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    protected $guarded = [];
    protected $with = ['filetype'];
    // protected $appends = ['filePath'];
    // protected $appends = ['realFilePath'];
    // protected $appends = ['real_file_path'];
    protected $appends = ['realFilePath'];
    // protected $appends = ['file_path'];

    public function filetype() {
        return $this->belongsTo(Filetype::class);
    }

    public function getRealFilePathAttribute() {
        return 'storage/' . $this->file_path;
        // return '123';
    }
    // public function file_path() {
    //     // return $this->file_path;
    //     return 'cc';
    // }

    public function scopeFilter($query, $filters)
    {
        // dd($query,$filters);
        return $filters->apply($query);
    }
}
