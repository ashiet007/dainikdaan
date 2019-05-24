@extends('layouts.backend')
@section('content')
<section class="py-5 col-md-12">
    <div class="container-fluid">
        <div class="row admin">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-center">Message</div>
                    <div class="card-body">
                        <a href="{{ url('/user/messages') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        {!! Form::open([
                        'method' => 'DELETE',
                        'url' => ['/user/messages', $messages->id],
                        'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm',
                        'title' => 'Delete Message',
                        'onclick'=>'return confirm("Confirm delete?")'
                        ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr><th>Sender Name</th>
                                    <td> {{ $messages->user->name }} </td></tr>
                                <tr><th>Message</th><td> {{ $messages->message }} </td>
                                </tr>
                                <tr><th>Date</th> <td>{{ $messages->created_at }}</td></tr>
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