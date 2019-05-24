@extends('layouts.backend')
@section('styles')
@endsection
@section('content')
<section class="py-5 col-md-12">
    <div class="container-fluid">
        <div class="row admin">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-center text-uppercase">Total Downline</div>
                    <div class="card-body">
                        <div class="container">
                            {!! Form::open(['method' => 'GET', 'url' => '/admin/downline/total-downline', 'class' => 'form-inline my-2 my-lg-0 float-right','role' => 'search'])  !!}
                            <div class="form-group">
                                {!! Form::label('user_name', 'User_name', ['class' => 'col-md-4 control-label font-weight-bold']) !!}
                                <div class="col-md-8">
                                    {!! Form::select('user_name',$username,null,('required' == 'required') ? ['class' => 'js-example-basic-single form-control', 'required' => 'required','placeholder'=> 'Select Username'] : ['class' => 'js-example-basic-single form-control','placeholder'=> 'Select Username']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-4">
                                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Show', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive my-table">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Date of Joining</th>
                                    <th>Sponsor ID</th>
                                    <th></th>
                                </tr>
                                </thead>
                                @if(!is_null($teamDetails))
                                    @foreach($teamDetails as $teamDetail)
                                        <tbody>
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $teamDetail->name }}</td>
                                            <td>{{ $teamDetail->email }}</td>
                                            <td>{{ $teamDetail->userDetails->mob_no }}</td>
                                            <td>{{ $teamDetail->created_at->format('d, M Y h:i:s A') }}</td>
                                            <td>{{ $teamDetail->sponsor_id }}</td>
                                        </tr>
                                        </tbody>
                                    @endforeach
                                @endif
                            </table>
                            @if(!is_null($teamDetails))
                                <div class="pagination"> {!! $teamDetails->appends(['user_name' => Request::get('user_name')])->render() !!} </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection