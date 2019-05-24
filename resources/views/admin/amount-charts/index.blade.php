@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row admin">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold text-center text-uppercase">Amount Charts</div>
                <div class="card-body">
                    {{-- <a href="{{ url('/admin/amount-charts/create') }}" class="btn btn-success btn-sm" title="Add New Amount Chart">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a> --}}
                    {!! Form::open(['method' => 'GET', 'url' => '/admin/amount-charts', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>#</th><th>Provide Amount</th><th>Receive Amount</th><th>Frequency</th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($amountcharts as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->provide_amount }}</td><td>{{ $item->receive_amount }}</td><td>{{ $item->frequency }}</td>
                                    <td>
                                        <a href="{{ url('/admin/amount-charts/' . $item->id) }}" title="View Amount Chart"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        {{-- <a href="{{ url('/admin/amount-charts/' . $item->id . '/edit') }}" title="Edit Amount Chart"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/amount-charts', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => 'Delete Amount Chart',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!} --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $amountcharts->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection