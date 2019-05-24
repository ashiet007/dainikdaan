@extends('layouts.backend')

@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="h6 text-uppercase mb-0">Active User</h2>
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Mobile No.</th>
                                    <th>State</th>
                                    <th>District</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($activeUsers as $activeUser)
                                    @if(!$activeUser->giveHelps->isEmpty())
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$activeUser->user_name}}</td>
                                            <td>{{$activeUser->name}}</td>
                                            <td>{{$activeUser->userDetails->mob_no}}</td>
                                            <td>{{$activeUser->userDetails->userState->name}}</td>
                                            <td>{{$activeUser->userDetails->userDistrict->name}}</td>
                                        </tr>
                                        @php
                                        $i =$i+1;
                                        @endphp
                                    @endif
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
