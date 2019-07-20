@extends('layouts.backend')

@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="h6 text-uppercase mb-0">User Profile</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col">
                                        <!-- ##### Tabs ##### -->
                                        <div class="col-12 col-lg-12">
                                            <div class="palatin-tabs-content">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="tab--1" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="false">Personal Info</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="tab--2" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Payment Details</a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab--1">
                                                        <div class="palatin-tab-content">
                                                            <!-- Tab Text -->
                                                            <div class="palatin-tab-text">
                                                                <div class="table-responsive my-table">
                                                                    <table class="table table-striped">
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
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab--2">
                                                        <div class="palatin-tab-content">
                                                            <!-- Tab Text -->
                                                            <div class="palatin-tab-text">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection