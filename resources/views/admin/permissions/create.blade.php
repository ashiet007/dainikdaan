@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row admin">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold text-center text-uppercase">Create New Permission</div>
                <div class="card-body">
                    <a href="{{ url('/admin/permissions') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    {!! Form::open(['url' => '/admin/permissions', 'class' => 'form-horizontal']) !!}
                    @include ('admin.permissions.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection