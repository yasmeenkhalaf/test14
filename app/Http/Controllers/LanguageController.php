<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Cookie;

class LanguageController extends Controller
{
    public function ChangeLanguage($lang)
    {

        if ($lang == 'ar') //Arabic
            Cookie::queue(Cookie::make('lang', 'ar'));
     
        else   //English
            Cookie::queue(Cookie::make('lang', 'en'));

        return redirect()->back();
    }
}