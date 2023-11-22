<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function index()
    {
        $image_all = Image::paginate(12);
        return view('front.image_gallery', compact('image_all'));
    }
}
