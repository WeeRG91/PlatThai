<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function delete($id)
    {
        $image = Image::find($id);
        Storage::disk('public')->delete($image->path);
        $image->delete();
        return back();
    }
}
