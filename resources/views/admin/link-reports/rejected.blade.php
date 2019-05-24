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
                                    <th>Sender Email</th>
                                    <th>Amount</th>
                                    <th>Receiver Username</th>
                                    <th>Receiver Name</th>
                                    <th>Receiver Email</th>
                                    <th>Rejected Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                @php
                                    $count = 1;
                                @endphp
                                @foreach($rejectedLinks as $rejectedLink)
                                    @if(!$rejectedLink->getHelps->isEmpty())
                                        <tbody>
                                        @foreach($rejectedLink->getHelps as $getHelp)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ $rejectedLink->user->user_name }}</td>
                                                <td>{{ $rejectedLink->user->name }}</td>
                                                <td>{{ $rejectedLink->user->email }}</td>
                                                <td>{{ $getHelp->pivot->assigned_amount }}</td>
                                                <td>{{ $getHelp->user->user_name }}</td>
                                                <td>{{ $getHelp->user->name }}</td>
                                                <td>{{ $getHelp->user->email }}</td>
                                                <td>{{ $getHelp->pivot->updated_at }}</td>
                                                <td>
                                                    {!! Form::open(['method' => 'GET', 'route' => 'linkReport.resendRejectedLink', 'class' => 'form-inline '])  !!}
                                                    <input type="hidden" name="give_help_id" value="{{ $rejectedLink->id }}">
                                                    <input type="hidden" name="get_help_id" value="{{ $getHelp->id }}">
                                                    <input type="hidden" name="amount" value="{{ $getHelp->pivot->assigned_amount }}">
                                                    <input type="submit" class="btn btn-success" value="Resend Link">
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                            @php
                                                $count = $count + 1;
                                            @endphp
                                        @endforeach
                                        </tbody>
                                    @endif
                                @endforeach
                            </table>
                            <div class="pagination"> {!! $rejectedLinks->appends(['user_id' => Request::get('user_id')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection