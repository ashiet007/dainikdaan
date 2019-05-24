@extends('layouts.backend')

@section('content')
    <div class="container-fluid">
            <div>
                    <h3>Create New Blog</h3>
                    <div>
                        <a href="{{ url('/admin/blog') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/blog', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('admin.blog.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
@endsection
