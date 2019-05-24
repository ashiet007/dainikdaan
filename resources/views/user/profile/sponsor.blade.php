@extends('layouts.backend')

@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="card-header bg-success">
                        <h2 class="h6 text-uppercase mb-0">Sponsor Details</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive my-table">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>Sponsor ID</th>
                                    <td>{{ $sponsorDetails->user_name }}</td>
                                </tr>
                                <tr>
                                    <th> Sponsor Name </th>
                                    <td class="text-capitalize">{{ $sponsorDetails->name }}</td>
                                </tr>
                                <tr>
                                    <th> Mobile Number </th>
                                    <td>{{ $sponsorDetails->userDetails['mob_no'] }}</td>
                                </tr>
                                <tr>
                                    <th> Email </th>
                                    <td>{{ $sponsorDetails->email }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection