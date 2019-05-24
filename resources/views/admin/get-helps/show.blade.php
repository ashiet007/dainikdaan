@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row admin">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold text-center">Get Help Helping {{ $gethelp->id }}</div>
                <div class="card-body">
                    <a href="{{ url('/admin/get-helps') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/admin/get-helps/' . $gethelp->id . '/edit') }}" title="Edit Get Help"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                    {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/get-helps', $gethelp->id],
                    'style' => 'display:inline'
                    ]) !!}
                    {!! Form::button('<i class="fas fa-trash-alt"></i> Delete', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete Get Help',
                    'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                    {!! Form::close() !!}
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $gethelp->id }}</td>
                                </tr><tr><th> Name </th><td> {{ $gethelp->users->name }} </td></tr><tr><th> Username </th><td> {{ $gethelp->users->username }} </td></tr> <tr><th> Amount </th><td> {{ $gethelp->amount }} </td></tr><tr><th> Type </th><td class="text-capitalize"> {{ $gethelp->type }} </td></tr>
                                <tr><th> Status </th><td class="text-capitalize"> {{ $gethelp->status }} </td></tr><tr><th> Completion State </th><td class="text-capitalize"> {{ $gethelp->completion_state }} </td></tr><tr><th> Balance Amount </th><td> {{ $gethelp->balance }} </td></tr><tr><th> Requested Date </th><td> {{ $gethelp->created_at }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection