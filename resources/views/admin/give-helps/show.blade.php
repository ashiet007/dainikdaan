@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row admin">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center font-weight-bold text-uppercase">Give Help {{ $givehelp->id }}</div>
                <div class="card-body">
                    <a href="{{ url('/admin/give-helps') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/admin/give-helps/' . $givehelp->id . '/edit') }}" title="Edit GiveHelp"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                    {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/give-helps', $givehelp->id],
                    'style' => 'display:inline'
                    ]) !!}
                    {!! Form::button('<i class="fas fa-trash-alt"></i> Delete', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete GiveHelp',
                    'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                    {!! Form::close() !!}
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $givehelp->id }}</td>
                                </tr><tr><th> Name </th><td> {{ $givehelp->users->name }} </td></tr><tr><th>Username </th><td> {{ $givehelp->users->username }} </td></tr>
                                <tr><th> Type </th><td class="text-capitalize"> {{ $givehelp->type }} </td></tr>
                                <tr><th> Status </th><td class="text-capitalize"> {{ $givehelp->status }} </td></tr><tr><th> Amount </th><td> {{ $givehelp->amoujnt }} </td></tr><tr><th> Completion State </th><td class="text-capitalize"> {{ $givehelp->completion_state }} </td></tr><tr><th> Balance Amount </th><td> {{ $givehelp->balance }} </td></tr><tr><th> Requested Date </th><td> {{ $givehelp->created_at }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection