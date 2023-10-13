<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Requests\TestimonialFormRequest;
use Illuminate\Support\Facades\File;


class adminTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }

    public function store(TestimonialFormRequest $request)
    {
        $validatedData = $request->validated();

        $testimonial = new Testimonial;
        $testimonial->title = $validatedData['title'];
        $testimonial->message = $validatedData['message'];


        $uploadPath = 'uploads/testimonial/';
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            $file->move('uploads/testimonial/', $filename);
            $testimonial->file = $uploadPath . $filename;
        }

        $testimonial->status = $request->status == true ? '1' : '0';
        $testimonial->user_id = auth()->user()->id;
        $testimonial->save();

        return redirect('admin/testimonials')->with('message', 'Testimonial Added Successfully');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit',compact('testimonial'));
    }

    public function update(TestimonialFormRequest $request, $testimonial)
    {
        $validatedData = $request->validated();

        $testimonial = Testimonial::findOrFail($testimonial);

        $testimonial->title = $validatedData['title'];
        $testimonial->message = $validatedData['message'];

        if ($request->hasFile('file')) {

            $uploadPath = 'uploads/testimonial/';

            $path = $testimonial->file;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/testimonial/',$filename);
            $testimonial->file = $uploadPath.$filename;
        }


        $testimonial->status = $request->status == true ? '1':'0';
        $testimonial->update();

        return redirect('admin/testimonials')->with('message','Testimonial Updated Successfuly');
    }



    public function destroy(Testimonial $testimonial)
    {
        $path = $testimonial->file;

        if (File::exists($path)) {
            File::delete($path);
        }
        $testimonial->delete();

        return redirect('admin/testimonials')->with('message', 'Testimonial Deleted Successfuly');
    }
}