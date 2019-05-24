@extends('layouts.backend')
@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="row admin">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header font-weight-bold text-center text-uppercase">Get Helps Working</div>
                        <div class="card-body">
                            {{--                    <a href="{{ url('/admin/get-helps-working/create') }}" class="btn btn-success btn-sm" title="Add New GetHelp">--}}
                            {{--                        <i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
                            {{--                    </a>--}}
                            {{--                    {!! Form::open(['method' => 'GET', 'url' => '/admin/get-helps-working', 'class' => 'form-inline my-2 my-lg-0 float-right'])  !!}--}}
                            {{--                    <div class="input-group">--}}
                            {{--                        <select name="status" class="form-control">--}}
                            {{--                            <option value="">Select Status...</option>--}}
                            {{--                            <option value="pending">Pending</option>--}}
                            {{--                            <option value="accepted">Accepted</option>--}}
                            {{--                            <option value="rejected">Rejected</option>--}}
                            {{--                        </select>--}}
                            {{--                        <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">--}}
                            {{--                        <span class="input-group-append">--}}
                            {{--                            <button class="btn btn-secondary" type="submit">--}}
                            {{--                            <i class="fa fa-search"></i>--}}
                            {{--                            </button>--}}
                            {{--                        </span>--}}
                            {{--                    </div>--}}
                            {{--                    {!! Form::close() !!}--}}
                            {{--                    <br/>--}}
                            {{--                    <br/>--}}
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Username</th><th>Amount</th><th>Status</th><th>Type</th><th>Requested Date</th><th>Actions</th><th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gethelps as $item)
                                        <tr>
                                            <td>{{ $loop->iteration or $item->id }}</td>
                                            <td>{{ $item->user->name }}</td><td>{{ $item->user->user_name }}</td><td>{{ $item->amount }}</td><td class="text-capitalize">{{ $item->status }}</td><td class="text-capitalize">{{ $item->type }}</td><td>{{ $item->created_at }}</td>
                                            <td>
{{--                                                <a href="{{ url('/admin/get-helps-working/' . $item->id) }}" title="View GetHelp"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>--}}
{{--                                                <a href="{{ url('/admin/get-helps-working/' . $item->id . '/edit') }}" title="Edit Get Help Working"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>--}}
                                                {!! Form::open([
                                                        'method'=>'DELETE',
                                                        'url' => ['/admin/get-helps-working', $item->id],
                                                        'style' => 'display:inline'
                                                    ]) !!}
                                                {!! Form::button('<i class="fas fa-trash-alt"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Get Help Working',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            @if(count($item->giveHelps) >= 1 )
                                                <td><button class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$item->id}}">Show Sub-Transactions</button>
                                                    <div class="modal" id="myModal{{$item->id}}">
                                                        <div class="modal-dialog modal-style">
                                                            <div class="modal-content">
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Sub Transactions</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-borderless">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>#</th><th>Sender Name</th><th>Sender Username</th><th>Amount</th><th>Status</th><th>Requested Date</th><th>Action</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach($item->giveHelps as $giveHelp)
                                                                                <tr>
                                                                                    <td>{{$loop->iteration}}</td>
                                                                                    <td>{{ $giveHelp->user->name }}</td>
                                                                                    <td>{{ $giveHelp->user->user_name }}</td>
                                                                                    <td>{{ $giveHelp->pivot->assigned_amount }}</td>
                                                                                    <td class="text-capitalize">{{ $giveHelp->pivot->status }}</td>
                                                                                    <td>{{ $giveHelp->pivot->created_at }}
                                                                                    </td>
                                                                                    @if($giveHelp->pivot->status == 'pending')
                                                                                        <td>
                                                                                            {!! Form::open(['method' => 'post', 'route' => 'linkReport.deleteLink', 'class' => 'form-inline '])  !!}
                                                                                            <input type="hidden" name="get_help_id" value="{{ $item->id }}">
                                                                                            <input type="hidden" name="give_help_id" value="{{ $giveHelp->id }}">
                                                                                            <input type="hidden" name="amount" value="{{ $giveHelp->pivot->assigned_amount }}">
                                                                                            <input type="submit" class="btn btn-success" value="Delete">
                                                                                            {!! Form::close() !!}
                                                                                        </td>
                                                                                    @else
                                                                                        <td><input type="button" class="btn btn-success disabled" value="Delete">
                                                                                        </td>
                                                                                    @endif
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            @else
                                                <td><button class="btn btn-warning disabled">Show Sub-Transactions</button></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $gethelps->appends(['status'=> Request::get('status'), 'search' => Request::get('search')])->render() !!} </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection