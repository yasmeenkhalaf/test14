<?php

namespace App\Providers;
use Illuminate\Support\Facades\App;

use Illuminate\Support\ServiceProvider;
use Illuminate\Events\Dispatcher;

use Illuminate\Support\Facades\Cookie;
use TCG\Voyager\Facades\Voyager;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         // Change Language
         $this->Language();
         Voyager::addAction(\App\Actions\AddPostsAction::class);
    }

    protected function Language()
    {
        if (Cookie::has('lang')) {
            $lang = Cookie::get('lang');
            // Arabic Language
            if ($lang == 'ar')
                App::setlocale('ar');
            // Hebrew Language
           
            // Default Language
            else
                App::setlocale('en');
        } else
            App::setlocale('en');
    }
}
