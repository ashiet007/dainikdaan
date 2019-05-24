@extends('layouts.backend')

@section('content')
    <div class="container-fluid">     
        <div class="row admin">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-center text-uppercase">User Profiles</div>
                    <div class="card-body">
                        {{-- <a href="{{ url('/admin/user-profiles/create') }}" class="btn btn-success btn-sm" title="Add New User Profile">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a> --}}

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/user-profiles', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Username</th><th>District</th><th>State</th><th>Mobile No</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($userprofiles as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td><td>{{ $item->users->name }}</td><td>{{ $item->users->username }}</td>
                                        <td>{{ $item->district }}</td><td>{{ $item->state }}</td><td>{{ $item->mobile_no }}</td>
                                        <td>
                                            <a href="{{ url('/admin/user-profiles/' . $item->id) }}" title="View UserProfile"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/user-profiles/' . $item->id . '/edit') }}" title="Edit UserProfile"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                                            {{-- {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/user-profiles', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete UserProfile',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!} --}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $userprofiles->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
