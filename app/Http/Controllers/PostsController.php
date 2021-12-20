<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;

class PostsController extends Controller
{
    public function index(){
       
        $posts = Post::get();
          
        $compact = [
           
           
            'posts'=>$posts
    
        ];
        return view('posts/index')
            ->with($compact);
    
        }



        public function showPost($slug){
          
            $meta = embedMetas('Post',$slug);
    
            $post = Post::where([
                ['slug',$slug],
                ['is_active', '1']
            ])->first();
    
           
            return view('posts.post-inner')->with([
                'post' => $post,
    //            'category' => $category,
                'meta' => $meta,
            ])->with($this->getSiteIndex());
    
           
           
            }
}
