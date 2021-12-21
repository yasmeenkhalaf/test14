<?php

namespace App\Actions;

use TCG\Voyager\Models\Category;
use TCG\Voyager\Actions\AbstractAction;

class AddPostsAction extends AbstractAction
{
    public function getTitle()
    {
        return __('عرض المقالات');
    }

    public function getIcon()
    {
        return 'voyager-chat';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-success float-right',
        ];
    }

    public function getDefaultRoute()
    {
        return route('voyager.posts.show', ['id' => $this->data->id]);
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'categories';
    }
 
    public function shouldActionDisplayOnRow($row)
    {
        $category = Category::where([
                                                    ['id',$this->data->id],
                                                    ['slug','news']
                                                ])->count();
                                                
        if($category)
        // return $row->id = $row;
        return true;
    }
   
}