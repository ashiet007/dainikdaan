@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row admin">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold text-center">Amount Chart {{ $amountchart->id }}</div>
                <div class="card-body">
                    <a href="{{ url('/admin/amount-charts') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    {{-- <a href="{{ url('/admin/amount-charts/' . $amountchart->id . '/edit') }}" title="Edit Amount Chart"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/amount-charts', $amountchart->id],
                    'style' => 'display:inline'
                    ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete Amount Chart',
                    'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                    {!! Form::close() !!} --}}
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $amountchart->id }}</td>
                                </tr>
                                <tr><th> Provide Amount </th><td> {{ $amountchart->provide_amount }} </td></tr><tr><th> Receive Amount </th><td> {{ $amountchart->receive_amount }} </td></tr><tr><th> Frequency </th><td> {{ $amountchart->frequency }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection