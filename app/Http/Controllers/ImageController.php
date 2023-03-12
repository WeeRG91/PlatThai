<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index(Request $request)
    {

        $images = Image::all();

        return view('admin.image.index')->with('images', $images);
    }

    public function delete($id)
    {
        $image = Image::find($id);
        Storage::disk('public')->delete($image->path);
        $image->delete();
        return back();
    }
}
