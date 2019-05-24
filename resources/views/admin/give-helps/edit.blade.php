@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row admin">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center font-weight-bold text-uppercase">Edit Give Help #{{ $givehelp->id }}</div>
                <div class="card-body">
                    <a href="{{ url('/admin/give-helps') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    {!! Form::model($givehelp, [
                    'method' => 'PATCH',
                    'url' => ['/admin/give-helps', $givehelp->id],
                    'class' => 'form-horizontal',
                    'files' => true
                    ]) !!}
                    @include('admin.give-helps.form')
                    <div class="form-group {{ $errors->has('created_at') ? 'has-error' : ''}}">
                        {!! Form::label('created_at', 'Created at', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-8">
                            <input id="datetimepicker" type="text" class="form-control" name="created_at" placeholder="Select Date and Time">
                            {!! $errors->first('created_at', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Update', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#give-help-amount').hide();
    });
</script>
@endsection