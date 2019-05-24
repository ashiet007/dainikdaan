@extends('layouts.backend')

@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="h6 text-uppercase mb-0">Direct team</h2>
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
                                    <th>Status</th>
                                    <th>Total Direct Team</th>
                                    <th>Total Team</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($team as $member)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$member->user_name}}</td>
                                        <td>{{$member->name}}</td>
                                        <td>{{$member->userDetails->mob_no}}</td>
                                        <td>{{$member->userDetails->userState->name}}</td>
                                        <td>{{$member->userDetails->userDistrict->name}}</td>
                                        <td>{{$member->status}}</td>
                                        <td>{{count(getTotalDirectTeam($member->user_name))}}</td>
                                        <td>{{count(getTotalTeam($member->user_name))}}</td>
                                    </tr>
                                    @php
                                    $i = $i+1;
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
