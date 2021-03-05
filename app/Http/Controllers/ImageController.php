<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends BaseController
{
    public function index()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function update(Request $request, Image $product)
    {
    }

    public function destroy(Image $image)
    {
        $image_path = public_path('/products/') . $image->path;

        if (file_exists($image_path))
            @unlink($image_path);

        $image->delete();

        return $this->sendResponse([], 'Image deleted successfully.');
    }
}
