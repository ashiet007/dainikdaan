@extends('layouts.backend')
@section('content')
<section class="py-5 col-md-12">
    <div class="container-fluid">
        <div class="row admin">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-center text-uppercase">Users</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th><th>Sponsor ID</th><th>Name</th><th>Username</th><th>Password</th><th>Mobile Number</th><th>State</th><th>District</th><th>DOJ</th><th>Identity</th><th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->sponsor_id }}</td>
                                        <td><a href="{{ url('/admin/users', $item->id) }}">{{ $item->name }}</a></td><td>{{ $item->user_name }}</td>
                                        @if(!is_null($item->userPassword))
                                            <td>{{ $item->userPassword->password }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{ $item->userDetails->mob_no }}</td><td>{{ $item->userDetails->userState->name }}</td>
                                        <td>{{ $item->userDetails->userDistrict->name }}</td>
                                        <td>{{$item->created_at->format('d, M Y h:i:s A')}}</td>
                                        <td>{{$item->identity}}</td>
                                        <td>
                                            <a href="{{ url('/admin/users/' . $item->id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection