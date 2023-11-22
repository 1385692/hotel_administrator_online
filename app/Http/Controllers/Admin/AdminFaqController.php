<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class AdminFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::get();
        return view('admin.faq_view', compact('faqs'));
    }

    public function add()
    {
        return view('admin.faq_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'text' => 'required',
        ]);


        $obj = new Faq();
        $obj->heading = $request->heading;
        $obj->text = $request->text;
        $obj->save();

        return redirect()->back()->with('success', 'Answer is added successfully');
    }

    public function edit($id)
    {
        $faq_data = Faq::where('id', $id)->first();
        return view('admin.faq_edit', compact('faq_data'));
    }

    public function update(Request $request, $id)
    {
        $obj = Faq::where('id', $id)->first();

        $obj->heading = $request->heading;
        $obj->text = $request->text;
        $obj->update();

        return redirect()->back()->with('success', 'Answer is updated successfully');
    }

    public function delete($id)
    {
        $single_data = Faq::where('id', $id)->first();
        $single_data->delete();

        return redirect()->back()->with('success', 'Answer is deleted successfully');
    }
}
