@extends('layouts.backend')

@section('title', $role->exists ? 'Editing ' . $role->name : 'Create role')

@section('content')

	<div class="row">
	    <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('backend.roles.index') }}"> Back</a>
        </div>
	</div>

	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
    
    {!! Form::model( $role, [
        'method' => $role->exists ? 'PUT' : 'POST',
        'route' => $role->exists ? ['backend.roles.update', $role->id] : ['backend.roles.store'],
        'role' => 'form'
    ]) !!}

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>

		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Display Name:</strong>
                {!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission:</strong>
                <br/>
                @foreach($permissions as $value)

                	<label>{{ Form::checkbox('permissions[]', $value->id, ( in_array($value->id, $rolePermissions) ) ? true : false, array('class' => 'name')) }}
                	{{ $value->display_name }}</label>
                	<br/>
                @endforeach
            </div>
        </div>

        {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}

	</div>

	{!! Form::close() !!}

@endsection