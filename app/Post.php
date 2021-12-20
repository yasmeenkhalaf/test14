<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

 class Post extends Model
{
    use Translatable;
    protected $translatable = ['title', 'excerpt', 'body'];
}
