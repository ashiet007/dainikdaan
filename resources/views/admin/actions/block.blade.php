@extends('layouts.backend')
@section('styles')
@endsection
@section('content')
<section class="py-5 col-md-12">
    <div class="container-fluid">
        <div class="row admin">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-center text-uppercase">Block/Unblock User</div>
                    <div class="card-body">
                        <div class="container">
                            {!! Form::open(['method' => 'GET', 'route' => 'action.index', 'class' => 'form-inline my-2 my-lg-0 float-right'])  !!}
                            <div class="form-group">
                                {!! Form::label('user_id', 'Username', ['class' => 'col-md-4 control-label font-weight-bold']) !!}
                                <div class="col-md-8">
                                    {!! Form::select('user_id',$username,null,('required' == 'required') ? ['class' => 'js-example-basic-single form-control', 'required' => 'required', 'placeholder' => 'Select Username'] : ['class' => 'js-example-basic-single form-control', 'placeholder' => 'Select Username']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-4">
                                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Show', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive my-table">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Date of Joining</th>
                                    <th>Sponsor ID</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                @if(!is_null($user))
                                    <tbody>
                                    <tr>
                                        <td>{{ $user->user_name }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->userDetails->mob_no }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->sponsor_id }}</td>
                                        <td>
                                            {!! Form::open(['method' => 'GET', 'route' => 'action.adminAction', 'class' => 'form-inline '])  !!}
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            @if($user->status == 'blocked')
                                                <input type="submit" class="btn btn-success" value="Unblock">
                                            @else
                                                <input type="submit" class="btn btn-success" value="Block">
                                            @endif
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection