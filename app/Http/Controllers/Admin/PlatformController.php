<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Base5Controller;

class PlatformController extends Base5Controller
{
    public $route_name = "dashboard.platform";
    public $view_name = "dashboard.platform";




    public function setCreateResource($request)
    {
        return [
            'slug' => quickRandomString() . '-' . Str::slug($request->name_en),
            'image' => $this->uploadFile(request: $request, path: 'uploads/products'),
            'admin_data' => json_encode(auth()->user()),
        ];
    }
    public function setUpdateResource($request, $old_image)
    {
        return [
            'slug' => quickRandomString() . '-' . Str::slug($request->name_en),
            'image' => $this->uploadFile(request: $request, old_image: $old_image, path: 'uploads/products'),
            'admin_data' => json_encode(auth()->user()),
        ];
    }
}
