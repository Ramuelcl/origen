<?php
// https://write.corbpie.com/laravel-9-image-upload-and-validation-example/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    public function index()
    {
        return view('images.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $original_name = $request->image->getClientOriginalName(); //Original image file name

        $file_size = $request->image->getSize(); //Size in bytes

        $extension = $request->image->extension(); //Image file extension eg. jpg or png

        $directory = 'uploads/' . date('Y') . '/' . date('m'); //Upload and move image into this directory

        $id = Str::random(8); //Random 8 character string

        $image_name = $id . '.' . $extension;

        $full_save_path_name = $directory . '/' . $image_name;

        $request->image->move(public_path($directory), $image_name); //Save into: public/images

        DB::table('images')->insert([
            'id' => $id,
            'user_id' => Auth::id(),
            'size' => $file_size,
            'original_name' => $original_name,
            'directory' => $directory,
            'extension' => $extension,
            'uploaded' => date('Y-m-d H:i:s'),
        ]);

        return back()
            ->with('success', "You have successfully uploaded $original_name saved as: $image_name")
            ->with('image', $full_save_path_name);
    }
}
