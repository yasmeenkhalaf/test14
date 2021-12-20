<?php

use App\Page;
use App\Post;
use App\Slider;
use App\Service;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\URL;


function arabicDate($time)
{
    $months = ["Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر"];
    $days = ["Sat" => "السبت", "Sun" => "الأحد", "Mon" => "الإثنين", "Tue" => "الثلاثاء", "Wed" => "الأربعاء", "Thu" => "الخميس", "Fri" => "الجمعة"];
    $am_pm = ['AM' => 'صباحاً', 'PM' => 'مساءً'];

    $day = $days[date('D', strtotime($time))];
    $month = $months[date('M', strtotime($time))];
    $am_pm = $am_pm[date('A', strtotime($time))];
    $date = $day . ' ' . date('d', strtotime($time)) . ' - ' . $month . ' - ' . date('Y', strtotime($time)) . '   ' . date('h:i', strtotime($time)) . ' ' . $am_pm;
    $numbers_ar = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
    $numbers_en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    return str_replace($numbers_en, $numbers_ar, $day);
}

function embedMetas($page, $slug = null, $id = null)
{

    $lang = (request()->cookie('lang')) ? request()->cookie('lang') : "ar";
    $extlang = ($lang == "en") ? '_en' : "";
    $site_name = setting('site.title' . $extlang);
    $description = setting('site.description' . $extlang);
    $image = (setting('site.image')) ? getImage(setting('site.image')) : getImage(setting('site.logo'));
    $keywords = str_replace(" ", ",", setting('site.keywords' . $extlang));
    switch ($page) {

        case "main":
            $title = setting('site.title' . $extlang);
            $description = setting('site.description' . $extlang);
            $keywords = str_replace(" ", ",", setting('site.keywords' . $extlang));
            break;

        case "PostCategory":
            $category = Category::where('slug', $slug)->firstOrFail();
            $keywords = ($category->name) ? $category->name : $keywords;
            $title = $category->name . ' - ' . setting('site.title' . $extlang);
            $description = ($category->sdata) ? $category->sdata : setting('site.description' . $extlang);

            $image = ($category->image) ? asset('/storage/' . $category->image) : $image;

            break;

             case "About":
                 $about = \App\About::where('order',1)->firstOrFail();
                 $keywords = ($about->title) ? $about->title : $keywords;
                 $title = $about->title . ' - ' . setting('site.title' . $extlang);
                 $description = ($about->description) ? $about->description : setting('site.description' . $extlang);

                 $image = ($about->image) ? asset('/storage/' . $about->image) : $image;

                 break;
        case "Films":
            $video = \App\MediaSubcategory::where('id',$id)->firstOrFail();
            $keywords = ($video->name) ? $video->name : $keywords;
            $title = $video->name . ' - ' . setting('site.title' . $extlang);
            $description = ($video->description) ? $video->description : setting('site.description' . $extlang);

            $image = ($video->image) ? asset('/storage/' . $video->image) : $image;

            break;
        case "Media":
            $media = \App\Album::where('sub_cat',$id)->with('subCategory')->firstOrFail();
            $keywords = ($media->subCategory->name) ? $media->subCategory->name : $keywords;
            $title = $media->subCategory->name . ' - ' . setting('site.title' . $extlang);
            $description = ($media->subCategory->name) ? $media->subCategory->name : setting('site.description' . $extlang);

            $image = ($media->subCategory->image) ? asset('/storage/' . $media->subCategory->image) : $image;

            break;
            case "Video":
            $media = \App\AlbumEpisode::where('id',$id)->firstOrFail();
            $keywords = ($media->name) ? $media->name : $keywords;
            $title = $media->name . ' - ' . setting('site.title' . $extlang);
            $description = ($media->description) ? $media->description : setting('site.description' . $extlang);

            $image = ($media->subCategory->image) ? asset('/storage/' . $media->subCategory->image) : $image;

            break;

        case "Post":
            $post = Post::whereSlug($slug)->firstOrFail();
            $title = ($post->seo_title) ? $post->seo_title . ' - ' . setting('site.title' . $extlang) : $post->title . ' - ' . setting('site.title' . $extlang);
//            $description = ($post->meta_description) ? $post->meta_description :
//                (setting('site.description' . $extlang)) ? setting('site.description' . $extlang)
//            : Str::limit($post->excerpt,150);

            if($post->meta_description)
                $description=$post->meta_description;
            elseif(setting('site.description' . $extlang))
                $description=setting('site.description' . $extlang);
            else
                $description =Str::limit($post->excerpt,150);

            $keywords = ($post->meta_keywords) ? $post->meta_keywords : $keywords;
            $image = ($post->image) ? asset('/storage/' . $post->image) : $image;
            break;

        case "Page":
            $page = \TCG\Voyager\Models\Page::whereSlug($slug)->firstOrFail();
            $title = ($page->seo_title) ? $page->seo_title . ' - ' . setting('site.title' . $extlang) : $page->title . ' - ' . setting('site.title');


//            $description = ($page->meta_description) ? $page->meta_description :
//                (setting('site.description' . $extlang)) ? setting('site.description' . $extlang)
//                    : Str::limit($page->excerpt,150);

            if($page->meta_description)
                $description=$page->meta_description;
            elseif(setting('site.description' . $extlang))
                $description=setting('site.description' . $extlang);
            else
                $description =Str::limit($page->excerpt,150);

            $keywords = ($page->meta_keywords) ? $page->meta_keywords : $keywords;
            $image = ($page->image) ? asset('/storage/' . $page->image) : $image;
            break;
        case "Vedio":
            $video = Vedio::firstOrFail();
            $title = $video->title . ' - ' . setting('site.title');
            $keywords = ($video->title) ? $video->title : $keywords;
            $description = ($video->details) ? $video->details : setting('site.description');
            $image = getVidImage($video->image, $video->crop_image);
            break;
    }



    $title = fixString($title);
    $site_name = fixString($site_name);
    $description = fixString($description);
    $keywords = fixString($keywords);
    $meta = [
        'site_name' => $site_name,
        'title' => Str::limit($title, 60),
        'description' => $description,
        'keywords' => $keywords,
        'url' => URL::current(),
        'image' => $image
    ];

    return $meta;
}

function fixString($text)
{
    $text = str_replace('"', "", $text);
    $text = str_replace("'", "", $text);
    $text = htmlspecialchars($text);
    $text = str_replace("\n", "", $text);
    $text = str_replace("\r", "", $text);
    $text = str_replace("\n\r", "", $text);
    $text = str_replace("\l", "", $text);
    return ($text);
}

function getImage($path = null, $crop = null, $width = null, $height = null, $ratio = false)
{
    $fileInfo = pathinfo(storage_path() . $path);
    $path = str_replace("\\", "//", $path);

    if ($crop) {
        $cropName = $fileInfo['basename'];
        if (file_exists('storage/croped/' . $cropName))
            $image = 'storage/croped/' . $cropName;
        else $image = uploadCropImage($crop, $cropName);
    } elseif ($path && file_exists('storage/' . $path)) {
        $image = 'storage/' . $path;
    } else {
        $image = 'img/not-found.jpg';
        $fileInfo = pathinfo(storage_path() . $image);
    }

    $ext = $fileInfo['extension'];
    if ($ratio) $thumbName = "ratio-" . $width . "-" . $height . $fileInfo['filename'] . "." . $ext;
    else $thumbName = $width . "-" . $height . $fileInfo['filename'] . "." . $ext;

    if (!isset($width) && !isset($height) && file_exists('storage/' . $path)) $thumb = 'storage/' . $path;
    else if (!isset($width) && !isset($height) && !file_exists('storage/' . $path)) $thumb = 'img/not-found.jpg';
    else $thumb = 'storage/thumbs/' . $thumbName;

    if ((!file_exists($thumb))) {
        $img = resizeImage($image, $width, $height, $ratio);
    } else $img = asset($thumb);

    return $img;
}

function getWatermarkImage($post_id,$imagePath = null, $watermarkPath = null,$pos='bottom-right'){

    $pos_slash = strrpos($imagePath,"/");
    $folder_name=substr($imagePath,0,$pos_slash);

    $destinationPath = public_path('/storage/posts/post_'.$post_id.'/');
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
    }
    $fileInfo = pathinfo(storage_path() . $imagePath);
    $imagePath = str_replace("\\", "//", $imagePath);
    $image = public_path('storage/' . $imagePath);
    $ext = $fileInfo['extension'];
    $fileName = $fileInfo['filename'];
//    $fileName = $post_id;

    $img = Image::make($image);
    /* insert watermark at bottom-right corner with 10px offset */
    $img->insert(public_path($watermarkPath), $pos, 10, 10);
    $save_path=public_path('/storage/posts/post_'.$post_id.'/'.$fileName.".".$ext);
    if (!file_exists($save_path)) {
        $img->save($save_path);
    }
    $img = '/storage/posts/post_' . $post_id .'/' . $fileName . "." . $ext;

    return $img;

//
//    $img = Image::make(public_path("storage/".$imagePath));
//
//    /* insert watermark at bottom-right corner with 10px offset */
//    $img->insert(public_path('storage/'.$watermarkPath), 'bottom-right', 10, 10);
//
//    $img->save();
//return ;
//    dd('saved image successfully.');
//    if (!file_exists('watermark')) {
//        mkdir('watermark', 666, true);
//    }
//    $img = Image::make(public_path("storage/".$imagePath));
//
//    $img->insert(public_path("storage/".$watermarkPath), $pos, 10, 10);
//
//    $img->save(public_path('watermark/new.png'));
//    dd('saved image successfully.');

////   dd(storage_path().'/'.$watermarkPath);
////    $img = Image::make(public_path('storage/1/borken.png'));
//    $fileInfo = pathinfo(storage_path() . $imagePath);
//    $imagePath = str_replace("\\", "//", $imagePath);
//    $ext = $fileInfo['extension'];
//
//    /* insert watermark at bottom-right corner with 10px offset */
//    $imagePath->insert(public_path('storage/'.$watermarkPath), 'bottom-right', 10, 10);
//
//    $imagePath->save(public_path('watermark/main-new.png'));
//
//    dd('saved image successfully.');
}



function uploadCropImage($blbImg, $name)
{

    $image = $blbImg;
    list($type, $image) = explode(';', $image);
    list(, $image)      = explode(',', $image);

    $image = base64_decode($image);
    $image_name = $name;
    $path = public_path('storage/croped/' . $image_name);

    file_put_contents($path, $image);
    return 'storage/croped/' . $image_name;
}

function resizeImage($path, $width = null, $height = null, $ratio = false)
{

    $image = $path;
    $fileInfo = pathinfo(storage_path() . $path);
    $ext = $fileInfo['extension'];

    if (strpos($path, 'img.youtube') !== false) {
        $getvdid = explode('/', $path);
        $filename = $getvdid[4] . $fileInfo['filename'];
    } else  $filename = $fileInfo['filename'];

    if ($ratio) $thumb = "ratio-" . $width . "-" . $height . $filename . "." . $ext;
    else $thumb = $width . "-" . $height . $filename . "." . $ext;

    $destinationPath = public_path('storage/thumbs');

    if (!file_exists($destinationPath)) {

        mkdir($destinationPath, 0755, true);
    }

    $img = Image::make($image);

    $img->fit($width, $height)->save($destinationPath . '/' . $thumb);

    // if($ratio){
    //     $img->resize($width, $height, function ($constraint) {
    //         $constraint->aspectRatio();
    //     })->save($destinationPath.'/'.$thumb);
    // } else{
    //     $img->resize($width, $height, 'center', true)->save($destinationPath.'/'.$thumb);
    // }

    return asset('/storage/thumbs/' . $thumb);

    /*
    // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
    $img->fit(600, 360);
    // crop the best fitting 1:1 ratio (200x200) and resize to 200x200 pixel
    $img->fit(200);
    // add callback functionality to retain maximal original image size
    $img->fit(800, 600, function ($constraint) {
        $constraint->upsize();
    });
    */

    /*
    // resize image to fixed size
    $img->resize(300, 200);
    // resize only the width of the image
    $img->resize(300, null);
    // resize only the height of the image
    $img->resize(null, 200);
    // resize the image to a width of 300 and constrain aspect ratio (auto height)
    $img->resize(300, null, function ($constraint) {
        $constraint->aspectRatio();
    });
    // resize the image to a height of 200 and constrain aspect ratio (auto width)
    $img->resize(null, 200, function ($constraint) {
        $constraint->aspectRatio();
    });
    // prevent possible upsizing
    $img->resize(null, 400, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });
    */

    /*
    // resize image canvas
    $img->resizeCanvas(300, 200);
    // resize only the width of the canvas
    $img->resizeCanvas(300, null);
    // resize only the height of the canvas
    $img->resizeCanvas(null, 200);
    // resize the canvas by cutting out bottom right position
    $img->resizeCanvas(300, 200, 'bottom-right');
    // resize the canvas relative by setting the third parameter to true
    $img->resizeCanvas(10, -10, 'center', true);
    // set a background-color for the emerging area
    $img->resizeCanvas(1280, 720, 'center', false, 'ff00ff');
    */
}

function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
{
    $name = !is_null($filename) ? $filename : str_random(25);

    $file = $uploadedFile->storeAs($folder, $name . '.' . $uploadedFile->getClientOriginalExtension(), $disk);

    return $file;
}

function getVidImage($path = null, $crop = null, $width = null, $height = null, $ratio = false)
{

    if (strpos($path, 'graph.facebook') !== false) {
        return ($path);
    } else {
        $fileInfo = pathinfo(storage_path() . $path);

        if ($crop) {
            $cropName = $fileInfo['basename'];
            if (file_exists('storage/croped/' . $cropName))
                $image = 'storage/croped/' . $cropName;
            else $image = uploadCropImage($crop, $cropName);
        } elseif (filter_var($path, FILTER_VALIDATE_URL)) {
            $image = $path;
        } elseif ($path && file_exists('storage/' . $path)) {
            $image = 'storage/' . $path;
        } else {
            $image = 'img/not-found.jpg';
            $fileInfo = pathinfo(storage_path() . $image);
        }

        $ext = $fileInfo['extension'];
        if (strpos($path, 'img.youtube') !== false) {
            $getvdid = explode('/', $path);
            $filename = $getvdid[4] . $fileInfo['filename'];
        } else  $filename = $fileInfo['filename'];

        if ($ratio) $thumbName = "ratio-" . $width . "-" . $height . $filename . "." . $ext;
        else $thumbName = $width . "-" . $height . $filename . "." . $ext;


        if (!isset($width) && !isset($height)) $thumb = 'storage/' . $path;

        else $thumb = 'storage/thumbs/' . $thumbName;


        if ((!file_exists($thumb))) {

            $img = resizeImage($image, $width, $height, $ratio);
        } else $img = asset($thumb);

        return $img;
    }
}