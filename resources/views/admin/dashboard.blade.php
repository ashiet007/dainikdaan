@extends('layouts.backend')
@section('styles')
@endsection
@section('content')
@php
	$username = Auth::User()->user_name;
    $i = 1;
    $j = 100;
    $timestamp = date("Y-m-d H:i:s");
@endphp
<section class="py-5">
<div class="container-fluid px-xl-5">

        <div class="row">
            <div class="col-xl-12 col-lg-12 mb-4 mb-xl-0">
                <div class="theme-bg-color shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                    <div class="flex-grow-1 d-flex align-items-center">
                        <div class="dot mr-3 bg-violet"></div>
                        <div class="text">
                            <h6 class="mb-0 text-white font-weight-bold">My Referral Link</h6><span class="text-gray" id="foo">{{ route('register') }}?sponsor-id={{ $username }}</span>
                        </div>
                    </div>
                    <button class="btn btn-muted"><i class="btn-clip" data-clipboard-action="copy" data-clipboard-target="#foo">Copy</i></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <marquee direction="left" onmouseover="this.stop()" onmouseout="this.start()"><p><span class="text-danger font-weight-bold">News</span> {{ $news->details }} <span class="font-weight-bold">Posted Date: {{$news->updated_at->format('d, M Y h:i:s')}}</span></p></marquee>
            </div>
        </div>
</div>
<div class="container-fluid px-xl-5">
    <div class="row admin">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-faded font-weight-bold text-center"><h3><strong>Company Reporting Panel</strong></h3>
                </div>
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold">TOTAL SYSTEM ID:</label>
                                </div>
                                <div class="col-md-4">
                                    {{ $totalSystemId }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold">TOTAL SYSTEM FUND:</label>
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-rupee-sign"></i> {{$totalSystemFund}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold">TOTAL NEW ID:</label>
                                </div>
                                <div class="col-md-4">
                                    {{$totalNewId}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold">TOTAL ACCEPTED FUND:</label>
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-rupee-sign"></i> {{$totalAcceptedFund}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold">TOTAL ACTIVE ID:</label>
                                </div>
                                <div class="col-md-4">
                                    {{$totalActiveId}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold">TOTAL REJECTED FUND:</label>
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-rupee-sign"></i> {{$totalRejectedFund}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold">TOTAL INACTIVE ID:</label>
                                </div>
                                <div class="col-md-4">
                                    {{$totalInActiveId}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold">TOTAL BALANCE FUND:</label>
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-rupee-sign"></i> {{$totalBalanceFund}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold">TOTAL BLOCKED ID:</label>
                                </div>
                                <div class="col-md-4">
                                    {{$totalBlockedId}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold">TOTAL ADDED FUND:</label>
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-rupee-sign"></i> {{ $totalAddedFund }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold">TOTAL POST REJECTED FUND:</label>
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-rupee-sign"></i> {{$postRejectedFund}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="font-weight-bold">TOTAL RECEIVERS FUND:</label>
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-rupee-sign"></i> {{ $totalReceiverFund }}
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

