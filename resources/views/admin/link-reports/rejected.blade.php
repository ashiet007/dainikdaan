@extends('layouts.backend')
@section('styles')
@endsection
@section('content')
<section class="py-5 col-md-12">
    <div class="container-fluid">
        <div class="row admin">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-center text-uppercase">Total Rejected Links</div>
                    <div class="card-body">
                        <div class="container">
                            {!! Form::open(['method' => 'GET', 'route' => 'linkReport.rejectedLink', 'class' => 'form-inline my-2 my-lg-0 float-right'])  !!}
                            <div class="form-group">
                                {!! Form::label('user_id', 'Username', ['class' => 'col-md-4 control-label font-weight-bold']) !!}
                                <div class="col-md-8">
                                    {!! Form::select('user_id',$username,null,('required' == 'required') ? ['class' => 'js-example-basic-single form-control', 'required' => 'required', 'placeholder' => 'Select Username'] : ['class' => 'js-example-basic-single form-control', 'placeholder' => 'Select Username']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-4">
                                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Filter', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        </br>
                        </br>
                        <div class="table-responsive my-table">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Sender Username</th>
                                    <th>Sender Name</th>
                                    <th>Amount</th>
                                    <th>Receiver Username</th>
                                    <th>Receiver Name</th>
                                    <th>Rejected Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rejectedData as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data['user_name'] }}</td>
                                        <td>{{ $data['name'] }}</td>
                                        <td>{{ $data['amount'] }}</td>
                                        <td>{{ $data['rc_user_name'] }}</td>
                                        <td>{{ $data['rc_name'] }}</td>
                                        <td>{{ $data['created_date'] }}</td>
                                        <td>
                                            {!! Form::open(['method' => 'GET', 'route' => 'linkReport.resendRejectedLink', 'class' => 'form-inline '])  !!}
                                            <input type="hidden" name="give_help_id" value="{{ $data['id'] }}">
                                            <input type="hidden" name="get_help_id" value="{{ $data['get_help_id'] }}">
                                            <input type="hidden" name="amount" value="{{ $data['amount'] }}">
                                            <input type="submit" class="btn btn-success" value="Resend Link">
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
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