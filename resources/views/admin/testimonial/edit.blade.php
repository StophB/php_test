@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Edit Testimonial
                    <a href="{{ url('admin/testimonials') }}" class="btn btn-danger btn-sm text-white float-end">
                        BACK
                    </a>
                </h3>
            </div>
            <div class="card-body">

                @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <form action="{{ url('admin/testimonials/'.$testimonial->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ $testimonial->title }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Message</label>
                        <textarea name="message" class="form-control" rows="3">{{ $testimonial->message }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>File</label>
                        <input type="file" name="file" class="form-control">
                        <img src="{{ asset($testimonial->file) }}" style='width: 50px; height: 50px' alt="testimonial">
                    </div>
                    <div class="mb-3">
                        <label>Status</label> <br>
                        <input type="checkbox" {{ $testimonial->status == '1' ? 'checked' : ''}} style="width:30px; height:30px;" name="status"> Checked=Approved, Unchecked=Draft
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection