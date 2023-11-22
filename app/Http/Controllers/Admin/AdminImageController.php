<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class AdminImageController extends Controller
{
    public function index()
    {
        $images = Image::get();
        return view('admin.image_view', compact('images'));
    }

    public function add()
    {
        return view('admin.image_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);


        $ext = $request->file('photo')->extension();
        $final_name = time() .'.' . $ext;
        $request->file('photo')->move(public_path('uploads/'),$final_name);

        $obj = new Image();
        $obj->photo = $final_name;
        $obj->caption = $request->caption;
        $obj->save();

        return redirect()->back()->with('success', 'Photo is added successfully');
    }

    public function edit($id)
    {
        $image_data = Image::where('id', $id)->first();
        return view('admin.image_edit', compact('image_data'));
    }

    public function update(Request $request, $id)
    {
        $obj = Image::where('id', $id)->first();

        if($request->hasfile('photo'))
        {

            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif',
            ]);

            unlink(public_path('uploads/'.$obj->photo));
            $ext = $request->file('photo')->extension();
            $final_name = time() .'.' . $ext;
            $request->file('photo')->move(public_path('uploads/'),$final_name);
            
            $obj->photo = $final_name;
        }

        $obj->caption = $request->caption;
        $obj->update();

        return redirect()->back()->with('success', 'Photo is updated successfully');
    }

    public function delete($id)
    {
        $single_data = Image::where('id', $id)->first();
        unlink(public_path('uploads/'.$single_data->photo));
        $single_data->delete();

        return redirect()->back()->with('success', 'Photo is deleted successfully');
    }
}
