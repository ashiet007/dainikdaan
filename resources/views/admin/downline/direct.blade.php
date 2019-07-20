@extends('layouts.backend')
@section('styles')
@endsection
@section('content')
<section class="py-5 col-md-12">
    <div class="container-fluid">
        <div class="row admin">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-center text-uppercase">Total Direct Team</div>
                    <div class="card-body">
                        <div class="container">
                            {!! Form::open(['method' => 'GET', 'url' => '/admin/downline/total-direct-team', 'class' => 'form-inline my-2 my-lg-0 float-right','role' => 'search'])  !!}
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
                                    <th>Mobile Number</th>
                                    <th>Date of Joining</th>
                                    <th>Sponsor ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!is_null($teamDetails))
                                    @foreach($teamDetails as $teamDetail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $teamDetail->name }}</td>
                                            <td>{{ $teamDetail->userDetails->mob_no }}</td>
                                            <td>{{ $teamDetail->created_at->format('d, M Y h:i:s A') }}</td>
                                            <td>{{ $teamDetail->sponsor_id }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection