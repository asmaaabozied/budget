<?php

use Carbon\Carbon;
//use Hash;
use Intervention\Image\Facades\Image;

define('Paginate_number', 10);
define('Limit', 10);
define('Maps', ['create', 'read', 'update', 'delete']);
define('Mapss', ['read']);

function UploadImage($path, $model, $request)
{
    $image = $request->file('image');
    $filename = $image->getClientOriginalName();
//    $mytime =Carbon::now();
//    //   $filename = $mytime->toDateTimeString()."_".$filenames->hashName();
//
//    $filename = $mytime->toDateTimeString()."_".md5($filenames);
    //Fullsize
    $image->move(public_path().'/'.$path.'/', $filename);

    $image_resize = Image::make(public_path().'/'.$path.'/'.$filename);
    // $image_resize->resize(1080, 1080);
    // $image_resize->insert(base_path('/images/logo.png'), 'bottom-right', 2, 2)->save(base_path($path.'/' . $filename));
    $model->image = $filename;
    $model->save();
}
