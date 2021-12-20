<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Page;

class PagesController extends Controller
{
    public function index($slug){
      
        $page=Page::where('slug',$slug)->firstOrFail();
       
        return view('pages.index')->with([
            'page' => $page,
        ]);
    }
}
