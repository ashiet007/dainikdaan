@extends('layouts.backend')
@section('content')
<section class="py-5 col-md-12">
    <div class="container-fluid">
        <div class="row admin">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-center text-uppercase">News {{ $news->type }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/news') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/news/' . $news->id . '/edit') }}" title="Edit News"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                        {{-- {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['admin/news', $news->id],
                        'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm',
                        'title' => 'Delete News',
                        'onclick'=>'return confirm("Confirm delete?")'
                        ))!!}
                        {!! Form::close() !!} --}}
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $news->id }}</td>
                                </tr>
                                <tr><th> Subject </th><td> {{ $news->subject }} </td></tr><tr><th> Details </th><td> {{ $news->details }} </td></tr><tr><th> Type </th><td> {{ $news->type }} </td></tr><tr><th> Updated Date </th><td> {{ $news->updated_at }} </td></tr>
                                </tbody>
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