<html>
    <head>
        <meta charset="UTF-8">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <title>@yield('title') &mdash; Eybos Admin</title>

        <style>@yield('style')</style>

    </head>
    <body>
        <nav class="navbar navbar-static-top navbar-inverse">
            <div class="container">
                <div class="navbar-header"><a href="/" class="navbar-brand">The Sunday Sim</a></div>
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('backend.permissions.index') }}">Permissions</a></li>
                    <li><a href="{{ route('backend.roles.index') }}">Roles</a></li>
                    <li><a href="{{ route('backend.users.index') }}">Users</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><span class="navbar-text">Hello, {{ $admin->first_name }}</span></li>
                    <li><a href="{{ route('auth.logout')  }}">Logout</a></li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="com-md-12">
                    <h3>@yield('title')</h3>
                    
                    @if( $errors->any() )
                        <div class="alert alert-danger">
                            <strong>We found some errors!</strong>

                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if( $message = Session::get( 'success' ) )
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script>@yield( 'js' )</script>
    </body>
</html>