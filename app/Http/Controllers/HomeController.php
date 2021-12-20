<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Slider;
use App\Page;
use App\Service;
use App\Testimonial;
use App\Post;

class HomeController extends Controller
{
    public function index(){
        $slides = Slider::orderBy('created_at','desc')->get();
        $pages = Page::get();
        $about = Page::where('slug' , '=', 'about')->withTranslation('ar')->get();
        $services = Service::get();
        $testimonials = Testimonial::get();
        $posts = Post::get();
          
        $compact = [
           
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
