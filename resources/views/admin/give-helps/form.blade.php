@if($givehelp)
<div class="form-group">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        <input type="text" class="form-control" disabled="disabled" value="{{ $givehelp->user->name }}">
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
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'Username', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::select('user_id',$username,null,('required' == 'required') ? ['class' => 'js-example-basic-single form-control', 'required' => 'required','placeholder' =>'--Select Username--'] : ['class' => 'js-example-basic-single form-control','placeholder' =>'--Select Username--']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}" id="give-help-amount">
    {!! Form::label('amount', 'Amount', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
            <input type="number" name="amount" class="form-control" readonly value="500">
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

