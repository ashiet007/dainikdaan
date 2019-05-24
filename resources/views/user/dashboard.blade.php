@extends('layouts.backend')
@section('styles')
    <style>
        .btn{
            margin: 5px;
        }
        .text-uppercase {
            letter-spacing: 0.0em;
        }
        .card-body{
            min-height: 400px;
        }
    </style>
@endsection
@section('content')
    @php
    $username = Auth::User()->user_name;
    @endphp
    <div class="container-fluid px-xl-5">
        <section class="py-5">
            <div class="row">
                <div class="col-xl-12 col-lg-12 mb-4 mb-xl-0">
                    <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1 d-flex align-items-center">
                            <div class="dot mr-3 bg-violet"></div>
                            <div class="text">
                                <h6 class="mb-0">My Referral Link</h6><span class="text-gray" id="foo">{{ route('register.showRegistrationForm') }}?sponsor-id={{ $username }}</span>
                            </div>
                        </div>
                        <div class="icon text-white bg-violet"><i class="btn-clip" data-clipboard-action="copy" data-clipboard-target="#foo">Copy</i></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <marquee direction="left" onmouseover="this.stop()" onmouseout="this.start()"><p><span class="text-danger font-weight-bold">News</span> {{ $news->details }} <span class="font-weight-bold">Posted Date: {{$news->updated_at->format('d, M Y h:i:s')}}</span></p></marquee>
                </div>
                <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                    <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1 d-flex align-items-center">
                            <div class="dot mr-3 bg-violet"></div>
                            <div class="text">
                                <h6 class="mb-0">Total Team</h6><span class="text-gray">{{count(getTotalTeam($username))}}</span>
                            </div>
                        </div>
                        <div class="icon text-white bg-violet"><i class="fas fa-server"></i></div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                    <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1 d-flex align-items-center">
                            <div class="dot mr-3 bg-green"></div>
                            <div class="text">
                                <h6 class="mb-0">Direct Team</h6><span class="text-gray">{{count(getTotalDirectTeam($username))}}</span>
                            </div>
                        </div>
                        <div class="icon text-white bg-green"><i class="far fa-clipboard"></i></div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                    <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1 d-flex align-items-center">
                            <div class="dot mr-3 bg-blue"></div>
                            <div class="text">
                                <h6 class="mb-0">Total Earning</h6><span class="text-gray">{{totalIncome($username)}}</span>
                            </div>
                        </div>
                        <div class="icon text-white bg-blue"><i class="fa fa-dolly-flatbed"></i></div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                    <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1 d-flex align-items-center">
                            <div class="dot mr-3 bg-red"></div>
                            <div class="text">
                                <h6 class="mb-0">My Wallet Fund</h6><span class="text-gray">{{availableBalance($username,Auth::User()->id)}}</span>
                            </div>
                        </div>
                        <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="row mb-4">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="card">
                        <div class="card-header bg-danger">
                            <h2 class="h6 text-uppercase mb-0 text-white text-center">Give Help Links</h2>
                        </div>
                        <div class="card-body">
                            @if(!is_null($assignedGiveHelps))
                            @php
                                $giveHelpId = $assignedGiveHelps->id;
                                $i = 1000;
                            @endphp
                            @foreach($assignedGiveHelps->getHelps as $getHelp)
                            <div class="table border border-danger table-danger rounded font-weight-bold">
                                <br>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Username:
                                        </div>
                                        <div class="col-md-6 font-weight-light">
                                            {{ $getHelp->user->user_name }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Name:
                                        </div>
                                        <div class=" col-md-6 text-uppercase font-weight-light">
                                            {{ $getHelp->user->name }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Email:
                                        </div>
                                        <div class=" col-md-6 font-weight-light">
                                            {{ $getHelp->user->email }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Mobile Number:
                                        </div>
                                        <div class=" col-md-6 font-weight-light">
                                            {{ $getHelp->user->userDetails['mob_no'] }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Sponsor Number:
                                        </div>
                                        <div class=" col-md-6 font-weight-light">
                                            @php
                                                $data = getDetails($getHelp->user->sponsor_id)
                                            @endphp
                                            {{ !empty($data)?$data->userDetails->mob_no:'N/A'}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            State:
                                        </div>
                                        <div class=" col-md-6 text-uppercase font-weight-light">
                                            {{ $getHelp->user->userDetails->userState->name }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            District:
                                        </div>
                                        <div class=" col-md-6 text-uppercase font-weight-light">
                                            {{ $getHelp->user->userDetails->userDistrict->name }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Bank Name:
                                        </div>
                                        <div class=" col-md-6 text-uppercase font-weight-light">
                                            {{ $getHelp->user->userDetails->userBank->name }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Account Number:
                                        </div>
                                        <div class=" col-md-6 text-uppercase font-weight-light">
                                            {{ $getHelp->user->userDetails['account_no'] }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Account Type:
                                        </div>
                                        <div class=" col-md-6 text-uppercase font-weight-light">
                                            {{ $getHelp->user->userDetails['account_type'] }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            IFSC Code:
                                        </div>
                                        <div class=" col-md-6 text-uppercase font-weight-light">
                                            {{ $getHelp->user->userDetails['ifsc_code'] }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Branch:
                                        </div>
                                        <div class=" col-md-6 font-weight-light">
                                            {{ $getHelp->user->userDetails['branch'] }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Paytm Number:
                                        </div>
                                        <div class=" col-md-6 font-weight-light">
                                            {{ isset($getHelp->user->userDetails['paytm_no'])? $getHelp->user->userDetails['paytm_no']:'N/A'}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Gpay Number:
                                        </div>
                                        <div class=" col-md-6 font-weight-light">
                                            {{ isset($getHelp->user->userDetails['gpay_no'])? $getHelp->user->userDetails['paytm_no']:'N/A'}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Give Help Amount:
                                        </div>
                                        <div class=" col-md-6 font-weight-light">
                                            <i class="fas fa-rupee-sign"></i> {{ $getHelp->pivot->assigned_amount }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Link Created Date:
                                        </div>
                                        <div class=" col-md-6 font-weight-light">
                                            {{ $getHelp->pivot->created_at->format('d, M Y h:i:s A') }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 font-weight-bold">
                                            Status:
                                        </div>
                                        <div class=" col-md-6">
                                            <span class="text-danger text-uppercase font-weight-bold" style="font-size: 20px;"> {{ $getHelp->pivot->status }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid container-padding mr-auto">
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$i}}"><i class="fas fa-upload"></i> Upload Slip</button>
                                    <!-- The Modal -->
                                    <div class="modal" id="myModal{{$i}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Upload Proof Slip</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <form action="{{route('proof.uploadProof')}}" enctype="multipart/form-data" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="give_help_id" value="{{$giveHelpId}}">
                                                        <input type="hidden" name="user_id" value="{{$getHelp->user->id}}">
                                                        <input type="hidden" name="get_help_id" value="{{$getHelp->id}}">
                                                        <input type="file" name="proof_file_name" class="form-control">
                                                        <input class="btn btn-primary" type="submit" value="upload">
                                                    </form>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger btn-timer"><i class="fas fa-clock"></i> Timer</button>
                                        <button type="button" class="btn btn-danger btn-timer" id="demo{{$i}}"></button>
                                    </div>
                                    <script>
                                        // Set the date we're counting down to
                                        var countDownDate{{$i}} = new Date("{{ date('Y-m-d H:i:s', strtotime( $getHelp->pivot->created_at ) + 18 * 3600 + 12 * $getHelp->pivot->extend_timer_count * 3600) }}").getTime();
                                        // Update the count down every 1 second
                                        var x{{$i}} = setInterval(function() {
                                            // Get todays date and time
                                            var now = new Date().getTime();

                                            // Find the distance between now and the count down date
                                            var distance = countDownDate{{$i}} - now;

                                            // Time calculations for days, hours, minutes and seconds
                                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                            // Output the result in an element with id="demo"
                                            document.getElementById("demo{{$i}}").innerHTML = days + "d " + hours + "h "
                                                + minutes + "m " + seconds + "s ";

                                            // If the count down is over, write some text
                                            if (distance < 0) {
                                                clearInterval(x{{$i}});
                                                document.getElementById("demo{{$i}}").innerHTML = "00:00:00";
                                            }
                                        }, 1000);
                                    </script>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#messageModal{{$i}}"><i class="fas fa-comment-alt"></i> Message</button>
                                    <!-- The Modal -->
                                    <div class="modal" id="messageModal{{$i}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Send Message to {{ $getHelp->user->name }}</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <form action="{{route('user.message')}}" enctype="multipart/form-data" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="receiver_id" value="{{$getHelp->user->id}}">
                                                        <label id="message" class="text-dark">Message</label>
                                                        <textarea id="message" name="message" class="form-control" required></textarea>
                                                        <input class="btn btn-primary" type="submit" value="send">
                                                    </form>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#viewModal{{$i}}"><i class="fas fa-eye"></i> View Slip</button>
                                    <!-- The Modal -->
                                    <div class="modal" id="viewModal{{$i}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Proof Slip</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    @if($getHelp->pivot->proof_file_name != null)
                                                        <img src="{{url('uploads/proof-files/'.$getHelp->pivot->proof_file_name)}}" width="100%">
                                                    @else
                                                        <img src="{{ asset('images/noimage.png') }}" width="100%">
                                                    @endif
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        @php
                            $i = $i + 1;
                        @endphp
                        @endforeach
                        @else
                            <!--    If No Receiver Available  -->
                                <div class="container user-container text-center font-weight-bold" style="padding: 100px;">
                                    No Receiver Available.... <img src="{{asset('images/sad.png')}}" height="50" width="50">
                                </div>
                                <!--    //If No Receiver Available  -->
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h2 class="h6 text-uppercase mb-0 text-center text-white">Get Help Links</h2>
                        </div>
                        <div class="card-body">
                            @if(!$assignedGetHelps->isEmpty())
                                @php
                                    $j = 2000;
                                @endphp
                                @foreach($assignedGetHelps as $assignedGetHelp)
                                    @php
                                        $getHelpId = $assignedGetHelp->id;
                                    @endphp
                                @if(!$assignedGetHelp->giveHelps->isEmpty())
                                    @foreach($assignedGetHelp->giveHelps as $giveHelp)
                                        <div class="table table-success border border-success rounded font-weight-bold theme-color">
                                            <br>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 font-weight-bold">
                                                        Name:
                                                    </div>
                                                    <div class=" col-md-6 text-uppercase font-weight-light">
                                                        {{ $giveHelp->user->name }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 font-weight-bold">
                                                        Username:
                                                    </div>
                                                    <div class=" col-md-6 font-weight-light">
                                                        {{ $giveHelp->user->user_name }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 font-weight-bold">
                                                        Email:
                                                    </div>
                                                    <div class=" col-md-6 font-weight-light">
                                                        {{ $giveHelp->user->email }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 font-weight-bold">
                                                        Mobile Number:
                                                    </div>
                                                    <div class=" col-md-6 font-weight-light">
                                                        {{ $giveHelp->user->userDetails['mob_no'] }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 font-weight-bold">
                                                        Sponsor Number:
                                                    </div>
                                                    <div class=" col-md-6 font-weight-light">
                                                        @php
                                                        $data = getDetails($giveHelp->user->sponsor_id)
                                                        @endphp
                                                        {{!empty($data)?$data->userDetails->mob_no:'N/A' }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 font-weight-bold">
                                                        State:
                                                    </div>
                                                    <div class=" col-md-6 text-uppercase font-weight-light">
                                                        {{ $giveHelp->user->userDetails->userState->name }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 font-weight-bold">
                                                        District:
                                                    </div>
                                                    <div class=" col-md-6 text-uppercase font-weight-light">
                                                        {{ $giveHelp->user->userDetails->userDistrict->name }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 font-weight-bold">
                                                        Help Amount:
                                                    </div>
                                                    <div class=" col-md-6 font-weight-light">
                                                        <i class="fas fa-rupee-sign"></i> {{ $giveHelp->pivot->assigned_amount }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 font-weight-bold">
                                                        Link Created Date:
                                                    </div>
                                                    <div class=" col-md-6 font-weight-light">
                                                        {{ $giveHelp->pivot->created_at->format('d,M Y h:i:s A') }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 font-weight-bold">
                                                        Status:
                                                    </div>
                                                    <div class=" col-md-6 font-weight-light">
                                                        <span class="text-uppercase font-weight-bold text-danger" style="font-size: 20px;">{{ $giveHelp->pivot->status }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container-fluid container-padding">
                                                <button class="btn btn-success" data-toggle="modal" data-target="#viewModal{{$j}}"><i class="fas fa-eye"></i> View Slip</button>
                                                <div class="modal" id="viewModal{{$j}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Proof Slip</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                @if($giveHelp->pivot->proof_file_name != null)
                                                                    <img src="{{url('uploads/proof-files/'.$giveHelp->pivot->proof_file_name)}}" width="100%">
                                                                @else
                                                                    <img src="{{ asset('images/noimage.png') }}" width="100%">
                                                                @endif
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($giveHelp->pivot->status == 'pending')
                                                    <form action="{{route('user.acceptHelp')}}" method="post" style="display: inline;">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="get_help_id" value="{{ $getHelpId }}">
                                                        <input type="hidden" name="give_help_id" value="{{ $giveHelp->id }}">
                                                        <input type="hidden" name="sender_id" value="{{ $giveHelp->user->id }}">
                                                        <button type="submit" class="btn btn-success"  onclick="return confirm('Confirm Accept?');"><i class="fas fa-check-square"></i> Accept</button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-success disabled"><i class="fas fa-check-square"></i> Accept</button>
                                                @endif
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success btn-timer"><i class="fas fa-clock"></i> Timer</button>
                                                    <button type="button" class="btn btn-success btn-timer" id="demo{{$j}}"></button>
                                                </div>
                                                <script>
                                                    // Set the date we're counting down to
                                                    var countDownDate{{$j}} = new Date("{{ date('Y-m-d H:i:s', strtotime( $giveHelp->pivot->created_at ) + 18 * 3600 + 12 * $giveHelp->pivot->extend_timer_count * 3600) }}").getTime();
                                                    // Update the count down every 1 second
                                                    var x{{$j}} = setInterval(function() {
                                                        // Get todays date and time
                                                        var now = new Date().getTime();

                                                        // Find the distance between now and the count down date
                                                        var distance = countDownDate{{$j}} - now;

                                                        // Time calculations for days, hours, minutes and seconds
                                                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                                        // Output the result in an element with id="demo"
                                                        document.getElementById("demo{{$j}}").innerHTML = days + "d " + hours + "h "
                                                            + minutes + "m " + seconds + "s ";

                                                        // If the count down is over, write some text
                                                        if (distance < 0) {
                                                            clearInterval(x{{$j}});
                                                            document.getElementById("demo{{$j}}").innerHTML = "00:00:00";
                                                        }
                                                    }, 1000);
                                                </script>
                                                @if($giveHelp->pivot->status == 'pending' && time() >= strtotime( $giveHelp->pivot->created_at ) + 18 * 3600 + 12 * $giveHelp->pivot->extend_timer_count * 3600)
                                                    <form method="post" action="{{route('user.rejectHelp')}}" style="display: inline;">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="get_help_id" value="{{ $getHelpId }}">
                                                        <input type="hidden" name="give_help_id" value="{{ $giveHelp->id }}">
                                                        <input type="hidden" name="amount" value="{{ $giveHelp->pivot->assigned_amount }}">
                                                        <input type="hidden" name="sender_id" value="{{ $giveHelp->user->id }}">
                                                        <button class="btn btn-success" onclick="return confirm('Confirm Reject?');"><i class="fas fa-times-circle"></i> Reject</button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-success disabled"><i class="fas fa-times-circle"></i> Reject</button>
                                                @endif
                                                <button class="btn btn-success" data-toggle="modal" data-target="#messageModal{{$j}}"><i class="fas fa-comment-alt"></i> Message</button>
                                                <div class="modal" id="messageModal{{$j}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Send Message to {{ $giveHelp->user->name }}</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form action="{{route('user.message')}}" method="post">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="receiver_id" value="{{$giveHelp->user->id}}">
                                                                    <label id="message" class="text-dark">Message</label>
                                                                    <textarea id="message" name="message" class="form-control" required></textarea>
                                                                    <input class="btn btn-primary" type="submit" value="send">
                                                                </form>
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($giveHelp->pivot->status == 'pending' && $giveHelp->pivot->extend_timer_count != 1)
                                                    <form method="post" action="{{route('user.extendTimer')}}" style="display: inline;">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="get_help_id" value="{{$getHelpId}}">
                                                        <input type="hidden" name="give_help_id" value="{{$giveHelp->id}}">
                                                        <button class="btn btn-success"><i class="fas fa-plus-square"></i> Ext.Timer</button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-success" disabled="disabled"><i class="fas fa-plus-square"></i> Ext.Timer</button>
                                                @endif
                                            </div>
                                            <br>
                                        </div>
                                        @php
                                            $j = $j + 1;
                                        @endphp
                                    @endforeach
                                    @endif
                                @endforeach
                                @if($j == 2000)
                                    <div class="container user-container text-center font-weight-bold" style="padding: 100px;">
                                        No Provider Available.... <img src="{{asset('images/sad.png')}}" height="50" width="50">
                                    </div>
                                @endif
                            @else
                                <div class="container user-container text-center font-weight-bold" style="padding: 100px;">
                                    No Provider Available.... <img src="{{asset('images/sad.png')}}" height="50" width="50">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection