@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Testimonials List
                        <a href="{{ url('admin/testimonials/create') }}" class="btn btn-primary btn-sm text-white float-end">
                            Add testimonials
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonials as $testimonial)
                                <tr>
                                    <td>{{ $testimonial->id }}</td>
                                    <td>{{ $testimonial->title }}</td>
                                    <td>{{ $testimonial->message }}</td>
                                    <td>
                                        <img src="{{ asset("$testimonial->file") }}" style='width: 70px; height: 70px'
                                            alt="testimonial">
                                    </td>
                                    <td>
                                        {{ $testimonial->status == '0' ? 'Draft' : 'Approved' }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/testimonials/' . $testimonial->id . '/edit') }}"
                                            class="btn btn-success btn-sm">Edit</a>
                                        <a href="{{ url('admin/testimonials/' . $testimonial->id) . '/delete' }}"
                                            onclick="return confirm('Are you sure you want to delete this testimonial')"
                                            class="btn btn-danger btn-sm">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
