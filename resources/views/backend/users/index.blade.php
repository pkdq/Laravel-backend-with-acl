@extends('layouts.backend')

@section('title', 'Users')

@section('content')

    <a href="{{ route('backend.users.create')  }}" class="btn btn-primary">Create new User</a>
    
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Roles</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td><a href="{{ route('backend.users.edit', $user->id)  }}">{{ $user->first_name . ' ' . $user->last_name  }}</a></td>
                        <td>{{ $user->email  }}</td>
                        <td>
                            @if( !empty( $user->roles ) )
                                @foreach( $user->roles as $role )
                                    <label class="label label-success">{{ $role->display_name }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('backend.users.edit', $user->id)  }}">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('backend.users.confirm', $user->id)  }}">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    {!! $users->render() !!}
@endsection