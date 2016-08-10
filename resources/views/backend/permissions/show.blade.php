@extends('layouts.backend')

@section('content')
<div class="container">

    <h1>Permission : {{ $permission->display_name }}
        <a href="{{ url('backend/permissions/' . $permission->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Permission"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['backend/permissions', $permission->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Permission',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $permission->id }}</td>
                </tr>
                <tr><th> Name </th><td> {{ $permission->name }} </td></tr><tr><th> Display Name </th><td> {{ $permission->display_name }} </td></tr><tr><th> Description </th><td> {{ $permission->description }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
