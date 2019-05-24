@extends('layouts.backend')

@section('content')
<section class="py-5 col-md-12">
    <div class="container-fluid">
        <div class="container">
            <div class="card">
                <div class="card-header text-center">
                    <h2 class="h6 text-uppercase mb-0">Income Report</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 font-weight-bold text-uppercase">
                            Total Income:
                        </div>
                        <div class="col-md-8">
                            <i class="fas fa-rupee-sign"></i> {{$income}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 font-weight-bold text-uppercase">
                            Available Balance For withdrawal:
                        </div>
                        <div class="col-md-8">
                            <i class="fas fa-rupee-sign"></i> {{ $availableBalance }}
                            @if($availableBalance >= 500)
                                &nbsp;&nbsp;
                                <button class="btn bg-success" data-toggle="modal" data-target="#myModal"> Withdraw</button>
                                <!-- The Modal -->
                                <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Enter Amount</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="alert alert-success">
                                                        Working income withdrawal minimum 500 and maximum 2000 per day multiple of 500.
                                                    </div>
                                                </div>
                                                <form action="{{route('income.workingWithrawal')}}" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="input-group">
                                                <span class="input-group-prepend">
                                                    <button class="btn btn-secondary btn-home">
                                                        <i class="fas fa-rupee-sign"></i>
                                                    </button>
                                                </span>
                                                        <input type="hidden" name="balance" class="form-control" value="{{$availableBalance}}">
                                                        <input type="number" name="amount" class="form-control" required="required">
                                                        <span class="input-group-append">
                                                    <button class="btn btn-secondary" type="submit">
                                                        Withdraw
                                                    </button>
                                                </span>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                &nbsp;&nbsp;<button class="btn btn-success disabled"> Withdraw</button>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <h3 class="text-center font-weight-bold">Transactions</h3>
                    <div class="table-responsive my-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Amount</th>
                                <th>Request Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            @foreach($getHelps as $getHelp)
                                <tbody>
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $getHelp->amount }}</td>
                                    <td>{{ $getHelp->created_at->format('d, M Y h:i:s A') }}</td>
                                    <td>{{ $getHelp->status }}</td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                        <div class="pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection