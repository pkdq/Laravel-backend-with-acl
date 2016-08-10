@extends('layouts.backend')

@section('title', 'Roles')

@section('content')

	@permission('role-create')
        <a class="btn btn-primary" href="{{ route('backend.roles.create') }}"> Create New Role</a>
    @endpermission

	<table class="table table-bordered">
		<tr>
			<th>No</th>
			<th>Name</th>
			<th>Description</th>
			<th width="280px">Action</th>
		</tr>

		@foreach ($roles as $key => $role)
		<tr>
			<td>{{ ++$i }}</td>
			<td>{{ $role->display_name }}</td>
			<td>{{ $role->description }}</td>
			<td>
				<a href="{{ route('backend.roles.show',$role->id) }}" class="btn btn-success btn-xs" title="View Permission"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>

				@permission('role-edit')
    				<a href="{{ route('backend.roles.edit',$role->id) }}" class="btn btn-primary btn-xs" title="Edit Permission"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
				@endpermission
				
				
	        	{!! Form::open([
                    'method'=>'DELETE',
                    'route' => ['backend.roles.destroy', $role->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Permission" />', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-xs',
                            'title' => 'Delete Role',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ));!!}
                {!! Form::close() !!}
	        	
				{{-- @permission('role-delete')
					{!! Form::open(['method' => 'DELETE','route' => ['backend.roles.destroy', $role->id],'style'=>'display:inline']) !!}
		            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
		        	{!! Form::close() !!}
	        	@endpermission --}}
			</td>
		</tr>
		@endforeach

	</table>

	{!! $roles->render() !!}

@endsection