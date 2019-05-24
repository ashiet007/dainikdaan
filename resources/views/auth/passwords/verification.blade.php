@extends('layouts.app')
@section('content')
    <div class="mian-content inner-page">
        <div class="header-top-w3layouts">
            <div class="container">
                <header>
                    @include('partials.headerNavbar')
                </header>
            </div>
        </div>
    </div>
    <!--// banner-text -->
    <!-- /breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home.index') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">Reset Password</li>
    </ol>
    <!-- //breadcrumb -->
    <section class="banner-bottom-w3ls py-lg-5 py-md-5 py-3">
        <div class="container">
            <div class="inner-sec-w3layouts py-lg-5 heading-padding py-3">
                <h3 class="tittle text-center mb-md-5 mb-4">Mobile Verification</h3>
                    <form class="form-horizontal" method="POST" action="{{ route('password.verifyOtp') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('otp') ? ' has-error' : '' }}">
                            <label for="otp" class="col-md-4 control-label">Enter OTP</label>
                            <div class="col-md-6">
                                <input id="otp" type="number" class="form-control" name="otp" value=" " placeholder="Enter OTP" required autofocus>

                                @if ($errors->has('otp'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('otp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-4">
                                 <input class="form-control form-submit" type="submit" value="Verify OTP">
                                 {{-- <p><span id="count">30</span> seconds...</p>
                                <a class="btn btn-success" id="resend" href="{{ route('password.request') }}">
                                    Resend OTP-Start Again..
                                </a> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>           
@endsection
@section('scripts')
<script type="text/javascript">

window.onload = function(){

(function(){
  var counter = 30;

  setInterval(function() {
    counter--;
    if (counter >= 0) {
      $('#resend').removeAttr('href');  
      span = document.getElementById("count");
      span.innerHTML = counter;
    }
    // Display 'counter' wherever you want to display it.
    if (counter === 0) {
       $('#resend').attr('href','{{ route('password.request') }}');
        clearInterval(counter);
    }

  }, 1000);

})();

}

</script>
@endsection
