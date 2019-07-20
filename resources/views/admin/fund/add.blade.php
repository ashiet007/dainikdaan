@extends('layouts.backend')

@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="h6 text-uppercase mb-0">Add fund To User</h2>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{route('fund.addFund')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="control-label">User</label>
                                <div class="col-md-8">
                                    <select class="form-control js-example-basic-single" name="user_id" required>
                                        <option>--Select User--</option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}({{$user->user_name}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Enter Amount</label>
                                <div class="col-md-8">
                                    <input type="number" name="amount" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection