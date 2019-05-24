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
<div class="container">
    <div>
      <h3 class="text-center"><strong>Dashboard</strong></h3>
        <div class="container">
            <marquee direction="left" onmouseover="this.stop()" onmouseout="this.start()"><p><span class="text-danger font-weight-bold">News</span> {{ $news->details }} <span class="font-weight-bold">Posted Date: {{$news->updated_at->format('d, M Y h:i:s')}}</span></p></marquee>
        </div>
         <div class="container col-md-10">
            <div class="input-group">
              <span class="input-group-prepend">
                  <span class="input-group-text bg-secondary font-weight-bold text-white">My Referral Link:</span>
              </span>
              <input type="text" id="foo" class="form-control" value="{{ route('register.showRegistrationForm') }}?sponsor-id={{ $username }}" readonly="readonly">
              <span class="input-group-append">
                  <button class="btn btn-secondary btn-clip" data-clipboard-action="copy" data-clipboard-target="#foo">
                      <img src="{{ asset('images/clippy.svg') }}" width="13" alt="Copy to clipboard"> Copy
                  </button>
              </span>
          </div>
         </div>
    </div>
</div>
<div class="container-fluid">
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
            </div>
        </div>
    </div>
</div>
</div>
@endsection

