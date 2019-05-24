@extends('layouts.backend')

@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="h6 text-uppercase mb-0">Receiver List</h2>
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$user->user->user_name}}</td>
                                        <td>{{$user->user->name}}</td>
                                        <td>{{$user->amount}}</td>
                                        <td>{{$user->type}}</td>
                                        <td>{{$user->status}}</td>
                                        <td>{{$user->created_at->format('d, M Y h:i:s A')}}</td>
                                        <td>{{$user->match_order_date}}</td>
                                        <!-- Button to Open the Modal -->
                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                            Change Order
                                        </button></td>

                                        <!-- The Modal -->
                                        <div class="modal" id="myModal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Change Help Order Timestamp</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <form action="{{route('link.changeOrder')}}" method="post">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="getHelpId" value="{{$user->id}}">
                                                            <div class="form-group">
                                                                <label class="control-label">Enter Timestamp</label>
                                                                <div class="col-md-8">
                                                                    <input type="datetime-local" class="form-control" name="match_order_date">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                 <input type="submit" class="btn btn-success">
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    @php
                                        $i =$i+1;
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
