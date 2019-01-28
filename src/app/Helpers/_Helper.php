<?php

use Illuminate\Support\Str;
use App\Entity\Setting;

function nameToBaseEntity($name){
    return 'App\\Entity\\Base\\'.$name;
}

function nameToEntity($name){
    return 'App\\Entity\\Pages\\'.$name;
}

function get_class_short($class) {
    $path = explode('\\', get_class($class));
    return array_pop($path);
}

function keyToLabel($key){
    $key = Str::snake($key);
    return ucfirst(strtolower(str_replace("_", " ", $key)));
}

function getImageUrl($filename){
    if (empty($filename)) return getNoPhoto();
    return url('/') . '/assets/upload/md/' . $filename;
}

function getImageUrlSize($filename, $size){
    if (empty($filename)) return getNoPhoto();
    return url('/') . '/assets/upload/' . $size .'/'. $filename;
}

function getNoPhoto(){
    return url('/') . '/assets/admin/images/broken-image.png';
}

function getSettingByKey($key){
    $model = Setting::first();

    return @$model->$key;
}

function getNonListDetailsSection($model){
    $nonListType = [];
    $list = $model::FORM_LIST;
    foreach($model::FORM_TYPE as $key=>$type){
        if (!isset($list[$key])){
            $nonListType[] = $key;
        }
    }
    return $nonListType;
}

function countImage($data) {
    if ($data == '') $data = [];

    return count($data);
}


?>