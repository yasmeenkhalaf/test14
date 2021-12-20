<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Slider;
use TCG\Voyager\Models\Page;
use App\Service;
use App\Testimonial;
use App\Post;

class HomeController extends Controller
{
    public function index(){
        $lang = (request()->cookie('lang')) ? request()->cookie('lang') : "en";
        $slides = Slider::orderBy('created_at','desc')->get();
        $pages = Page::get();
        $about = Page::where('slug' , '=', 'about')->withTranslation('ar')->get();
        $services = Service::limit(10)->get();
        $testimonials = Testimonial::get();
        $posts = Post::get();
          
        $compact = [
            'lang' => $lang,
            'slides'=>$slides,
            'pages'=>$pages,
            'about'=>$about,
            'services'=>$services,
            'testimonials'=>$testimonials,
            'posts'=>$posts
    
        ];
        return view('home')
            ->with($compact);
    
        }
}
