@extends('layouts.backend')

@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="h6 text-uppercase mb-0">Daily Growth </h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 font-weight-bold text-uppercase">
                                Total Growth Income:
                            </div>
                            <div class="col-md-8">
                                <i class="fas fa-rupee-sign"></i> {{$income}}
                            </div>
                        </div>
                        <hr>
                        <h3 class="text-center font-weight-bold">Growth Details</h3>
                        <div class="table-responsive my-table">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Amount</th>
                                    <th>Added Date</th>
                                </tr>
                                </thead>
                                @foreach($userFunds as $userFund)
                                    <tbody>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $userFund->amount }}</td>
                                        <td>{{ $userFund->created_at->format('d, M Y h:i:s A') }}</td>
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