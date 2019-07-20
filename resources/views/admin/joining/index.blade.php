
@extends('layouts.backend')
@section('styles')
<style type="text/css">
    /*input {
        border-top: 1px solid #a4b7c1;
        border-bottom: 1px solid #a4b7c1;
    }*/
</style>
@endsection
@section('content')
<section class="py-5 col-md-12">
    <div class="container-fluid">
        <div class="row admin">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-center text-uppercase">Joining Report</div>
                    <div class="card-body">
                        <div class="container">
                            {!! Form::open(['method' => 'GET', 'route' => 'joining.index', 'class' => 'form-inline '])  !!}
                            <div class="input-group">
                            <span class="input-group-prepend">
                                <button class="btn btn-secondary">
                                <i class="far fa-calendar-alt"></i> From
                                </button>
                            </span>
                                <input type="date" class="form-control" name="start_date" required="required">
                                <span class="input-group-append">
                                <button class="btn btn-secondary">
                                <i class="far fa-calendar-alt"></i> To
                                </button>
                            </span>
                                <input type="date" class="form-control" name="end_date" required="required">
                                <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                <i class="fa fa-search"></i>
                                </button>
                            </span>
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
                                @if(!is_null($users))
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->userDetails->mob_no }}</td>
                                            <td>{{ $user->created_at->format('d, M Y h:i:s A') }}</td>
                                            <td>{{ $user->sponsor_id }}</td>
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