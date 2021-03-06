<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class Testimonial extends Model
{
    use Translatable;
    use Resizable;

    protected $translatable = ['name', 'position', 'content'];
}
