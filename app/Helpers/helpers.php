<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


// Helper variable;
const MIN_VALUE_FOR_WITHDRAW = 100;
const DEFAULT_BLANK_DATA = 'প্রযজ্য নয়';
const STATUS_ON = 'on';
const STATUS_OFF = 'off';


// ================ Image Upload =========================== //
function ImageUpload($new_file, $path, $old_image) {
    if (!file_exists(public_path($path))) {
        mkdir(public_path($path), 0777, true);
    }
    $file_name = Str::slug($new_file->getClientOriginalName()) . '_' . rand(111111, 999999) . '.' . $new_file->getClientOriginalExtension();
    $destinationPath = public_path($path);

    if($old_image != null) {
        if (File::exists(public_path($old_image))) {
            unlink(public_path($old_image));
        }
    }
    
    $new_file->move($destinationPath, $file_name);

    return $path . $file_name;
};


function removeImage($file) {
    if($file != null) {
        if (File::exists(public_path($file))) {
            unlink(public_path($file));
        }
    }
}





?>