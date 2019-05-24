@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row admin">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold text-center text-uppercase">Wallet Detail {{ $walletdetail->id }}</div>
                <div class="card-body">
                    <a href="{{ url('/admin/wallet-details') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/admin/wallet-details/' . $walletdetail->id . '/edit') }}" title="Edit WalletDetail"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                    {{-- {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/walletdetails', $walletdetail->id],
                    'style' => 'display:inline'
                    ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete WalletDetail',
                    'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                    {!! Form::close() !!} --}}
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $walletdetail->id }}</td>
                                </tr><tr><th> Name </th><td> {{ $walletdetail->users->name }} </td></tr><tr><th> Username </th><td> {{ $walletdetail->users->username }} </td></tr>
                                <tr><th> Paytm Number </th><td> {{ $walletdetail->paytm_number }} </td></tr><tr><th> Gpay Number </th><td> {{ $walletdetail->gpay_number }} </td></tr><tr><th> Bitcoin Address </th><td> {{ $walletdetail->bitcoin_address }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection