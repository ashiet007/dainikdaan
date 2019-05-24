@if($gethelp)
<div class="form-group">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        <input type="text" class="form-control" disabled="disabled" value="{{ $gethelp->users->name }}">
    </div>
</div>
@endif
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
       <select class="form-control js-example-basic-single" name="status" required="required">
            <option value="pending">Pending</option>
            <option value="accepted">Accepted</option>
            <option value="rejected">Rejected</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('identity') ? 'has-error' : ''}}">
    {!! Form::label('identity', 'Identity', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        <select class="form-control js-example-basic-single" name="identity" required="required">
            <option value="">--Select Identity--</option>
            <option value="real">Real</option>
            <option value="fake">Fake</option>
        </select>
        {!! $errors->first('identity', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'Username', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::select('user_id',$username,null,('required' == 'required') ? ['class' => 'js-example-basic-single form-control', 'required' => 'required','placeholder' => '--Select Username--'] : ['class' => 'js-example-basic-single form-control','placeholder' => '--Select Username--']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}" id="get-help-working-amount">
    {!! Form::label('amount', 'Amount', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::number('amount', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter Amount'] : ['class' => 'form-control', 'placeholder' => 'Enter Amount']) !!}
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Income Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        <select class="form-control js-example-basic-single" name="type" required="required">
            <option value="working">Working</option>
        </select>
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
