<div class="form-group {{ $errors->has('provide_amount') ? 'has-error' : ''}}">
    {!! Form::label('provide_amount', 'Provide Amount', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('provide_amount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('provide_amount', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('next_amount') ? 'has-error' : ''}}">
    {!! Form::label('next_amount', 'Next Amount', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('next_amount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('next_amount', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('receive_amount') ? 'has-error' : ''}}">
    {!! Form::label('receive_amount', 'Receive Amount', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('receive_amount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('receive_amount', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('frequency') ? 'has-error' : ''}}">
    {!! Form::label('frequency', 'Frequency', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('frequency', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('frequency', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
