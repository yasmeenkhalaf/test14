<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function setLocalization($lang) 
{
    if (in_array($lang, app()->config->get('app.locales'))) 
    {
        Session::put('locale', $lang);
    }
    return redirect()->back();
}
}
