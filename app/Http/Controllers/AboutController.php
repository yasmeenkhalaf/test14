<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
class AboutController extends Controller
{
    public function index(){
     

        $abouts=About::orderBy('order', 'Asc')
            ->get();
        $helaTeams=HelaTeam::get();
        $compact = [
          
            'abouts'=>$abouts,
            'helaTeams'=>$helaTeams,
        ];
        return view('about.index')
            ->with($compact)
            ->with($this->getSiteIndex());
    }
}
