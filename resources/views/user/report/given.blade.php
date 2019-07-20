@extends('layouts.backend')

@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="h6 text-uppercase mb-0">Give Help Report</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive my-table">
                            <table class="table table-border">
                                <thead>
                                <tr>
                                    <th>#</th><th>Amount</th><th>Status</th><th>Requested Date</th><th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($giveHelps as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->amount }}</td><td class="text-capitalize">{{ $item->status }}</td>
                                        <td>{{ $item->created_at->format('d, M Y h:i:s A') }}</td>
                                        @if(count($item->getHelps) >= 1 )
                                            <td><button class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$item->id}}">Show Sub-Transactions</button>
                                                <div class="modal" id="myModal{{$item->id}}">
                                                    <div class="modal-dialog modal-style">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Sub Transactions</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-borderless">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th><th>Receiver Name</th><th>Receiver Username</th><th>Amount</th><th>Status</th><th>Requested Date</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach($item->getHelps as $getHelp)
                                                                            <tr>
                                                                                <td>{{$loop->iteration}}</td>
                                                                                <td>{{ $getHelp->user->name }}</td>
                                                                                <td>{{ $getHelp->user->user_name }}</td>
                                                                                <td>{{ $getHelp->pivot->assigned_amount }}</td>
                                                                                <td class="text-capitalize">{{ $getHelp->pivot->status }}</td>
                                                                                <td>{{ $getHelp->pivot->created_at->format('d, M Y h:i:s A') }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @else
                                            <td><button class="btn btn-primary disabled">Show Sub-Transactions</button></td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination"> {!! $giveHelps->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
