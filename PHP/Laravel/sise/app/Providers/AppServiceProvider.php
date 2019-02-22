<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Carbon::setLocale('zh');
        // \View::share('channels',\App\Channel::all());
        \View::composer('*',function ($view){
            $channels = \Cache::rememberForever('channels',function (){
                return \App\Channel::all(); 
             });
            $coursetypes = \DB::table('coursetypes')->get();
            $filetypes = \DB::table('filetypes')->get();
            $view->with('channels',$channels); 
            $view->with('coursetypes',$coursetypes); 
            $view->with('filetypes',$filetypes); 
         });

        \Validator::extend('spamfree', 'App\Rules\SpamFree@passes');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if($this->app->isLocal()){
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
