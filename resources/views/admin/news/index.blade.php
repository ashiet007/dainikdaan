@extends('layouts.backend')
@section('content')
<section class="py-5 col-md-12">
    <div class="container-fluid">
        <div class="row admin">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-center text-uppercase">News</div>
                    <div class="card-body">
{{--                         <a href="{{ url('/admin/news/create') }}" class="btn btn-success btn-sm" title="Add New News">--}}
{{--                            <i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
{{--                        </a>--}}
                        {!! Form::open(['method' => 'GET', 'url' => '/admin/news', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                                    <th>#</th><th>Subject</th><th>Details</th><th>Type</th><th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($news as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->subject }}</td><td>{{ $item->details }}</td><td>{{ $item->type }}</td>
                                        <td>
                                            <a href="{{ url('/admin/news/' . $item->id) }}" title="View News"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/news/' . $item->id . '/edit') }}" title="Edit News"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                                            {{-- {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/admin/news', $item->id],
                                            'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete News',
                                            'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                            {!! Form::close() !!} --}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $news->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection