<div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : ''}}">
    {!! Form::label('mobile_no', 'Mobile No', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('mobile_no', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('mobile_no', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('alternate_mobile_no') ? 'has-error' : ''}}">
    {!! Form::label('alternate_mobile_no', 'Alternate Mobile No', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('alternate_mobile_no', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('alternate_mobile_no', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('district') ? 'has-error' : ''}}">
    {!! Form::label('district', 'District', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('district', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('district', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
    {!! Form::label('state', 'State', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('state', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
