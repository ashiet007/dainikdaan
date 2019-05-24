@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row admin">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold text-center text-uppercase">UserProfile {{ $userprofile->id }}</div>
                <div class="card-body">
                    <a href="{{ url('/admin/user-profiles') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/admin/user-profiles/' . $userprofile->id . '/edit') }}" title="Edit UserProfile"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                    {{-- {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/userprofiles', $userprofile->id],
                    'style' => 'display:inline'
                    ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete UserProfile',
                    'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                    {!! Form::close() !!} --}}
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr><th>Name</th><td>{{ $userprofile->users->name }}</td>
                                </tr><tr><th>Username</th><td>{{ $userprofile->users->username }}</td>
                                </tr><tr><th> District </th><td> {{ $userprofile->district }} </td></tr><tr><th> State </th><td> {{ $userprofile->state }} </td></tr><tr><th> Mobile No </th><td> {{ $userprofile->mobile_no }} </td></tr><tr><th>Alternate Mobile No </th><td> {{ $userprofile->alternate_mobile_no }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection