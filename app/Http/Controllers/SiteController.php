<?php

namespace App\Http\Controllers;
use App\LinksColumn;
use App\Post;
use App\Category;
class SiteController extends Controller
{
    public function getMeta($type = 'main')
    {
        $meta = embedMetas($type);
        return $meta;
    }


    public function GetCatsByPlugin($plugin)
    {
        $catsPlugin = [];

        $catsPlugin = Category::where([
            ['show_main','1'],
//            ['is_active','1'],
            ['main_design',$plugin]
        ])
        ->orderBy('order', 'Asc')
        ->get();
        return $catsPlugin;
    }
    function getPostsByPlugin($plugin){

        $PostsPlugin = [];

        $categories = $this->GetCatsByPlugin($plugin);
        foreach ($categories as $cat) {
            $category = Category::find($cat->id);
            $PostsPlugin[$category->id] = $category->posts()
                ->where([
                    ['posts.is_active', '1'],
                    ['posts.status','published']
                ])
                ->whereRaw('publishing_date <="'.date('Y-m-d H:i:s').'"')
                ->orderBy('posts.id', 'desc')
                ->take($cat->items_plugin)->get();
        }
        return $PostsPlugin;
    }

    function getArchievePlugin(){
        $ArchievePlugin = $this->GetCatsByPlugin('Archive');
        return $ArchievePlugin;
    }


    function getArchieveCats(){
        $categories = $this->getArchievePlugin();
        $ArchieveCats = [];

        foreach ($categories as $cat) {
            $category = Category::find($cat->id);
            $ArchieveCats[$category->id] = $category->subcategory()
                ->where([
                    ['show_main','1'],
                    ['is_active','1'],
                ])
                ->orderBy('order', 'Asc')
                ->get();
        }

        return $ArchieveCats;

    }
    function getMainPosts($limit=1){
        $posts = Post::where([
            ['status', 'PUBLISHED'],
            ['is_active','1'],
            ['featured', '1'],
        ])
            ->orderBy('id', 'desc')
            ->take($limit)->get();

        return $posts;
    }
    function getSiteIndex(){
        $links = array();
        $cols = LinksColumn::orderBy('order', 'Asc')->get();

        foreach($cols as $col){
            $links[$col->id] = $col->links()->orderBy('links.order', 'Asc')->paginate(10);
        }

        return ['cols' => $cols, 'links' => $links];

    }



}