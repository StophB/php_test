@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
    </div>

    <div class="card-body">
        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ url('/store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h1>Add Your Testimonial</h1>

            <fieldset>
                <label for="name">Titre:</label>
                <input type="text" id="name" name="title" class="form-control">

                <label for="mail">Message:</label>
                <textarea name="message" class="form-control" rows="3"></textarea>

                <label for="password">Image:</label>
                <input type="file" id="image" name="file" class="form-control">

            </fieldset>


            <button type="submit">ADD NEW TESTIMONIAL</button>

        </form>
    </div>



    <div class="home-testimonial">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center testimonial-pos">
                <div class="col-md-12 pt-4 d-flex justify-content-center">
                    <h2>Testimonials</h2>
                </div>
            </div>
            <div class="home-testimonial-bottom">
                <div class="container testimonial-inner">
                    <div class="row d-flex justify-content-center">
                        @foreach ($testimonials as $testimonial)
                            <div class="col-md-4 style-3">
                                <div class="tour-item ">
                                    <div class="tour-desc bg-white">
                                        <div class="d-flex justify-content-center pt-2 pb-2">
                                            <img class="tm-people" src="{{ asset("$testimonial->file") }}" alt="">
                                        </div>
                                        <div class="link-name d-flex justify-content-center">
                                            {{ $testimonial->user->name }}
                                        </div>

                                        <div class="tour-text color-grey-3 text-center">
                                            &ldquo;{{ $testimonial->message }}&rdquo;</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>

    @endsection
