<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Requests\TestimonialFormRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $testimonials = Testimonial::where('status', 1)
            ->latest()
            ->take(3)
            ->get();
        return view('home', compact('testimonials', 'users'));
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

        $testimonial->status = $request->status == '0';
        $testimonial->user_id = auth()->user()->id;

        $testimonial->save();

        return redirect('/')->with('message', 'Your Testimonial Added Successfully');
    }
}
