@extends('layouts.backend')
@section('styles')
@endsection
@section('content')
<section class="py-5 col-md-12">
    <div class="container-fluid">
        <div class="row admin">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-center text-uppercase">Total Pending Links</div>
                    <div class="card-body">
                        <div class="table-responsive my-table">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Sender Username</th>
                                    <th>Sender Name</th>
                                    <th>Sender Email</th>
                                    <th>Amount</th>
                                    <th>Receiver Username</th>
                                    <th>Receiver Name</th>
                                    <th>Receiver Email</th>
                                    <th>Created Date</th>
                                </tr>
                                </thead>
                                @php
                                    $count = 1;
                                @endphp
                                @foreach($pendingLinks as $pendingLink)
                                    @if(!$pendingLink->getHelps->isEmpty())
                                        <tbody>
                                        @foreach($pendingLink->getHelps as $getHelp)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ $pendingLink->user->user_name }}</td>
                                                <td>{{ $pendingLink->user->name }}</td>
                                                <td>{{ $pendingLink->user->email }}</td>
                                                <td>{{ $getHelp->pivot->assigned_amount }}</td>
                                                <td>{{ $getHelp->user->user_name }}</td>
                                                <td>{{ $getHelp->user->name }}</td>
                                                <td>{{ $getHelp->user->email }}</td>
                                                <td>{{ $getHelp->pivot->created_at->format('d, M Y h:i:s A') }}</td>
                                            </tr>
                                            @php
                                                $count = $count + 1;
                                            @endphp
                                        @endforeach
                                        </tbody>
                                    @endif
                                @endforeach
                            </table>
                            <div class="pagination"> {!! $pendingLinks->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection