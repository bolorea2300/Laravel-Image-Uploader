<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    function image($id)
    {
        $data_id = $id;
        $data = Image::select("image")->where('image', '=', $data_id)->first();
        $imagepath  = $data->file;

        return response()->file(storage_path("app/public/images/" . $imagepath));
    }

    function home()
    {
        $data = Image::select("image")->orderBy('created_at', 'desc')->paginate(10);

        return view("welcome", compact("data"));
    }

    function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:1024',
        ]);

        $path = $request->file("image")->store('public/images');
        $image = str_replace("public/images/", "", $path);

        Image::create([
            'image' => $image,
        ]);

        Image::select("image")->orderBy('created_at', 'desc')->paginate(10);

        return redirect("/");
    }
}
