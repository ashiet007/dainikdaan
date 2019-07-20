@extends('layouts.backend')

@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="h6 text-uppercase mb-0">Added Fund History</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Added date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($fundsList as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$item->user->user_name}}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>{{$item->amount}}</td>
                                        <td>{{$item->created_at->format('d, M Y h:i:s A')}}</td>
                                    </tr>
                                    @php
                                        $i =$i+1;
                                    @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
