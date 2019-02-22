<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    //
    protected $guarded = [];

    protected static function boot() {
        parent::boot();

        static::deleting(function ($course) {
            foreach($course->files as $file){
                Storage::disk('public')->delete($file->file_path);
                // \DB::table('files')->where('id',$file->id)->delete();
                $file->delete();
            }
        });
    }

    public function coursetype() {
        return $this->belongsTo(Coursetype::class);
    }

    public function files() {
        return $this->hasMany(File::class);
    }

    public function scopeFilter($query, $filters)
    {
        // dd($query,$filters);
        return $filters->apply($query);
    }
}
