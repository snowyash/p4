<!DOCTYPE html>
<html>
<head>

    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PawBook')</title>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js') }}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{ HTML::script('bootstrap/js/bootstrap.min.js') }}
    <!-- Include JQuery -->
    {{ HTML::script('http://code.jquery.com/jquery-1.10.2.js') }}

    <!-- JQuery UI Datepicker -->
    {{ HTML::style('https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css') }}
    {{ HTML::script('https://code.jquery.com/jquery-1.10.2.js') }}
    {{ HTML::script('https://code.jquery.com/ui/1.11.2/jquery-ui.js') }}

    <!-- Bootstrap -->
    {{ HTML::style('bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('/mystyle.css') }}

    <!-- Custom styles for this template -->
    {{ HTML::style('jumbotron-narrow.css') }}

    <!-- Montserrat Font -->
    {{ HTML::style('http://fonts.googleapis.com/css?family=Montserrat:400,700') }}

</head>

<body>

    <div class="navbar-wrapper">
      <div class="container">

        <div class="header">
        <nav>
          <ul class="nav nav-pills pull-right">
            @if(Auth::check())
                <li class="dropdown">
                  <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Account <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="/">Edit My Account</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Pets<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="/pet">See All Pets</a></li>
                    <li><a href="/pet/create">Add a Pet</a></li>
                  </ul>
                </li>
                <li><a href='/user/logout'>Log out {{ Auth::user()->email; }}</a></li>
            @else 
                <li><a href='/user/signup'>Sign up</a></li>
                <li><a href='/user/login'>Log in</a></li>
            @endif
          </ul>
        </nav>
        <h2 class="text-muted"><a id="brand" href="/">PawBook</a></h2>
      </div>

    <div class="container">
        @yield('content')
    </div>
    
    <footer class="footer">
        <p>&copy; PawBook 2015</p>
    </footer>
      
    </div>
    </div>

    {{ HTML::script('myscripts.js') }}
    
</body>
</html>