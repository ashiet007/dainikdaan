@extends('layouts.backend')
@section('styles')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>
        .btn:not(:disabled):not(.disabled).active {
            background-image: none;
            background: #dc3545;
        }
        .btn-primary {
            color: #fff;
            background-color: #4680ff;
            border-color: #4680ff;
        }
        .toggle-handle {
            background: #ffc107;
        }
    </style>
@endsection
@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="row admin">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header font-weight-bold text-center text-uppercase">Total Link ON/OFF</div>
                        <div class="card-body">
                            <form action="{{route('action.linkOnOff')}}" method="post">
                                {{csrf_field()}}
                                <div class="checkbox">
                                    <label>
                                        Total Link ON/OFF:
                                    </label>
                                    <input type="checkbox" {{$setting->link_status == 1?'checked':''}} name="link_status" data-toggle="toggle" value="1">
                                </div>
                                <div>
                                    <input class="btn btn-success" type="submit" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection