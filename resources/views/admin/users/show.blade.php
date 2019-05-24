@extends('layouts.backend')
@section('content')
<section class="py-5 col-md-12">
    <div class="container-fluid">
        <div class="row admin">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-center text-uppercase">User</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/users/' . $user->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr><th>Id</th><td>{{ $user->id }}</td>
                                </tr><tr><th>Name</th><td>{{ $user->name }}</td>
                                </tr><tr><th> Username </th><td> {{ $user->user_name }} </td></tr><tr><th> Password </th>
                                    @if(!is_null($user->userPassword))
                                        <td>{{ $user->userPassword->password }}</td>
                                    @else
                                        <td></td>
                                    @endif</tr><tr><th> Mobile Number </th><td> {{ $user->userDetails->mob_no }} </td></tr><tr><th>Alternate Mobile Number </th><td> {{ $user->userDetails->alternate_mob_no }} </td></tr><tr><th> Email </th><td> {{ $user->email }} </td></tr><tr><th> State </th><td> {{ $user->userDetails->userState->name }} </td></tr><tr><th> District </th><td> {{ $user->userDetails->userDistrict->name }} </td></tr><tr><th> Sponsor ID </th><td> {{ $user->sponsor_id }} </td></tr>
                                <tr><th> Identity </th><td class="text-capitalize"> {{ $user->identity }} </td></tr>
                                <tr><th> Status </th><td class="text-capitalize"> {{ $user->status }} </td></tr>
                                <tr><th> Date of Joining </th><td> {{ $user->created_at->format('d, M Y h:i:s A') }} </td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection