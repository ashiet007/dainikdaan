@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row admin">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold text-center text-uppercase">BankDetail {{ $bankdetail->id }}</div>
                <div class="card-body">
                    <a href="{{ url('/admin/bank-details') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/admin/bank-details/' . $bankdetail->id . '/edit') }}" title="Edit BankDetail"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                    {{-- {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/bankdetails', $bankdetail->id],
                    'style' => 'display:inline'
                    ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete BankDetail',
                    'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                    {!! Form::close() !!} --}}
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $bankdetail->id }}</td>
                                </tr><tr><th>Name </th><td> {{ $bankdetail->users->name }} </td></tr>
                                <tr><th>Username </th><td> {{ $bankdetail->users->username }} </td></tr>
                                <tr><th> Bank Name </th><td> {{ $bankdetail->bank_name }} </td></tr><tr><th> Account Number </th><td> {{ $bankdetail->account_number }} </td></tr><tr><th> IFSC Code </th><td> {{ $bankdetail->ifsc_code }} </td></tr><tr><th> Branch </th><td> {{ $bankdetail->branch }} </td></tr><tr><th> Account Type </th><td> {{ $bankdetail->account_type }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection