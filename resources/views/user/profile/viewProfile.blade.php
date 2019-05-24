@extends('layouts.backend')

@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="h6 text-uppercase mb-0">User Profile</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col">
                                        <ul class="nav nav-pills mb-1" id="pills-tab" role="tablist">
                                            <li class="nav-item font-weight-bold">
                                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Personal Info</a>
                                            </li>
                                            <li class="nav-item font-weight-bold">
                                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Payment Details</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                <div class="table-responsive my-table">
                                                    <table class="table table-striped table-borderless">
                                                        <tbody>
                                                        <tr>
                                                            <th>Name</th>
                                                            <td class="text-uppercase">{{ $userDetail->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th> Username </th>
                                                            <td> {{ $userDetail->user_name }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Email </th>
                                                            <td> {{ $userDetail->email }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Mobile Number </th>
                                                            <td> {{ $userDetail->userDetails['mob_no'] }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> State </th>
                                                            <td class="text-uppercase"> {{ $userDetail->userDetails->userState->name }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> District </th>
                                                            <td class="text-uppercase"> {{ $userDetail->userDetails->userDistrict->name }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Date of Joining </th>
                                                            <td class="text-uppercase"> {{ $userDetail->created_at->format('d, M Y h:i:s A') }} </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                <div class="table-responsive my-table">
                                                    <table class="table table-striped">
                                                        <tbody>
                                                        <tr>
                                                            <th>Bank Name</th>
                                                            <td class="text-uppercase">{{ $userDetail->userDetails->userBank->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th> Account Number </th>
                                                            <td class="text-uppercase"> {{ $userDetail->userDetails['account_no'] }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Account Type </th>
                                                            <td class="text-uppercase"> {{ $userDetail->userDetails['account_type'] }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> IFSC Code </th>
                                                            <td class="text-uppercase"> {{ $userDetail->userDetails['ifsc_code'] }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Branch </th>
                                                            <td class="text-uppercase"> {{ $userDetail->userDetails['branch'] }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Paytm Number</th>
                                                            <td>{{ isset($userDetail->userDetails['paytm_no']) ?  $userDetail->userDetails['paytm_no']:'N/A'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th> GPay Number </th>
                                                            <td > {{ isset($userDetail->userDetails['gpay_no']) ?  $userDetail->userDetails['gpay_no']:'N/A' }} </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection