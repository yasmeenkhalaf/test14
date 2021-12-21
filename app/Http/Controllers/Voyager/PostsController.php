<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class PostsController extends VoyagerBaseController
{
  
            public function addPost($id)
            {
                $category = Category::where('id', $id)->get();


$post = Post::where('category_id',$id)->get();

//print_r($post);
//exit();

return view('voyager.posts.show')->with([
    'posts' => $posts,
   
]);
             
            }
}
