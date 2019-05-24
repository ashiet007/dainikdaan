@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row admin">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold text-center"><h3><strong>Edit Amount Chart #{{ $amountchart->id }}</strong></h3></div>
                <div class="card-body">
                    <a href="{{ url('/admin/amount-charts') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    {!! Form::model($amountchart, [
                    'method' => 'PATCH',
                    'url' => ['/admin/amount-charts', $amountchart->id],
                    'class' => 'form-horizontal',
                    'files' => true
                    ]) !!}
                    @include ('admin.amount-charts.form', ['submitButtonText' => 'Update'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection