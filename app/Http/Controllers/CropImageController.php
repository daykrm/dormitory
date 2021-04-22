<?php

namespace App\Http\Controllers;

use App\Models\YearConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CropImageController extends Controller
{
    //
    public function uploadCropImage(Request $request)
    {

        $year = YearConfig::find(1);
        $temp_folder_path = public_path('/');
        $path = 'dormitory/file/' . $year->year . '/';

        $image_parts = explode(';base64,', $request->image);
        $image_type_aux = explode('image/', $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';

        $tempImagePath = $temp_folder_path.$imageName;

        //save file to public_path
        file_put_contents($tempImagePath, $image_base64);

        $imageFullPath = $path . $imageName;
        Storage::disk('s3')->put($imageFullPath, file_get_contents($tempImagePath));

        return response()->json($imageFullPath);
    }
}
