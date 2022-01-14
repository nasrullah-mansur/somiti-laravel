<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

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