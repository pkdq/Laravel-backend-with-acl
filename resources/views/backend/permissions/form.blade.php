@extends('layouts.backend')

@section('title', $permission->exists ? 'Editing : ' . $permission->display_name : 'Create Permission')

@section('content')
<div class="container">

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    
    {!! Form::model( $permission, [
        'method' => $permission->exists ? 'put' : 'post',
        'route' => $permission->exists ? ['backend.permissions.update', $permission->id] : ['backend.permissions.store'],
        'role' => 'form'
    ]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name') !!}
               
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('display_name', 'Display Name') !!}
               
                {!! Form::text('display_name', null, ['class' => 'form-control']) !!} 
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
               
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>


        {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
    {!! Form::close() !!}

</div>
@endsection