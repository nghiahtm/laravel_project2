<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UserImageRequest;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    public function imageUpload(UserImageRequest $requestImg)
    {
            $image = $requestImg->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/avatar', $imageName);
            $requestImg->user()->image = "storage/avatar/".$imageName;
            $requestImg->user()->save();
            return $this->sentSuccessResponse("Upload Avatar Success");
    }
}
