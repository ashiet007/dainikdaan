@extends('layouts.backend')

@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="h6 text-uppercase mb-0">Rejected Help</h2>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">Get Help Rejected Links</h3>
                        <div class="table-responsive my-table">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Sender Name</th>
                                    <th>Sender Mobile No.</th>
                                    <th>Amount</th>
                                    <th>Rejected Date</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                @php
                                    $count1 = 1;
                                @endphp
                                @foreach($getHelps as $getHelp)
                                    @foreach($getHelp->giveHelps as $giveHelp)
                                        <tbody>
                                        <tr>
                                            <td>{{ $count1 }}</td>
                                            <td>{{ $giveHelp->user->name }}</td>
                                            <td>{{ $giveHelp->user->userDetails->mob_no }}</td>
                                            <td>{{ $giveHelp->pivot->assigned_amount }}</td>
                                            <td>{{ $giveHelp->pivot->updated_at->format('d,M Y h:i:s A') }}</td>
                                            <td>{{ $getHelp->type }}</td>
                                            <td>{{ $giveHelp->pivot->status }}</td>
                                        </tr>
                                        @php
                                            $count1 = $count1 + 1;
                                        @endphp
                                        </tbody>
                                    @endforeach
                                @endforeach
                            </table>
                            <div class="pagination"> {!! $getHelps->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                        <br>
                        <hr>
                        <h3 class="text-center font-weight-bold">Give Help Rejected Links</h3>
                        <div class="table-responsive my-table">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Receiver Name</th>
                                    <th>Receiver Mobile No.</th>
                                    <th>Amount</th>
                                    <th>Request Date</th>
                                    <th>Rejected Date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                @php
                                    $count2 = 1;
                                @endphp
                                @foreach($giveHelps as $giveHelp)
                                    @foreach($giveHelp->getHelps as $getHelp)
                                        <tbody>
                                        <tr>
                                            <td>{{ $count2 }}</td>
                                            <td>{{ $getHelp->user->name }}</td>
                                            <td>{{ $getHelp->user->userDetails->mob_no }}</td>
                                            <td>{{ $getHelp->pivot->assigned_amount }}</td>
                                            <td>{{ $getHelp->pivot->created_at->format('d, M Y h:i:s') }}</td>
                                            <td>{{ $getHelp->pivot->updated_at->format('d, M Y h:i:s') }}</td>
                                            <td>{{ $getHelp->pivot->status }}</td>
                                        </tr>
                                        @php
                                            $count2 = $count2 + 1;
                                        @endphp
                                        </tbody>
                                    @endforeach
                                @endforeach
                            </table>
                            <div class="pagination"> {!! $giveHelps->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
