<!DOCTYPE html>
<html>
<head>

    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield( 'title', 'PawBook' )</title>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{ HTML::script( 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js' ) }}
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{ HTML::script( 'bootstrap/js/bootstrap.min.js' ) }}
    
    <!-- Include JQuery -->
    {{ HTML::script( 'http://code.jquery.com/jquery-1.10.2.js' ) }}

    <!-- JQuery UI Datepicker -->
    {{ HTML::style( 'https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' ) }}
    {{ HTML::script( 'https://code.jquery.com/jquery-1.10.2.js' ) }}
    {{ HTML::script( 'https://code.jquery.com/ui/1.11.2/jquery-ui.js' ) }}

    <!-- Bootstrap -->
    {{ HTML::style( 'bootstrap/css/bootstrap.min.css' ) }}
    {{ HTML::style( '/mystyle.css' ) }}

    <!-- Custom styles for this template -->
    {{ HTML::style( 'jumbotron-narrow.css' ) }}

    <!-- Montserrat Font -->
    {{ HTML::style( 'http://fonts.googleapis.com/css?family=Montserrat:400,700' ) }}

</head>

<body>

    <div class="navbar-wrapper">
        <div class="container header">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed nav-button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" id="brand" href="/">PawBook</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right">
                    @if(Auth::check())
                        <li><a href="/pet">See All Pets</a></li>
                        <li><a href="/pet/create">Add a Pet</a></li>
                        <li><a href='/user/logout'>Log out {{ Auth::user()->email; }}</a></li>
                    @else 
                        <li><a href='/user/signup'>Sign up</a></li>
                        <li><a href='/user/login'>Log in</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        @yield( 'content' )
    </div>
    
    <footer class="container footer">
        <p>&copy; PawBook 2015</p>
    </footer>

    {{ HTML::script( 'myscripts.js' ) }}
    
</body>
</html>