<!DOCTYPE html>
<html lang="en" ng-app="DonateApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mimosa Mining Company</title>

    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/app/vendor/cfploader/loading-bar.css') }}" rel="stylesheet">
    <!-- Fonts -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" style='border-radius:0' role="navigation">

        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand logo text-" href="{{url('/')}}">ESB System</a>
            </div>

            <ul class="nav navbar-nav navbar-right navbar-collapse collapse">
                    @if(Auth::user())
                    <li><a href="{{url('submissions')}}" class="">Submissions</a></li>
                    <li><a href="{{url('notifications')}}" class="">Notifications</a></li>
                      <li><a href="{{url('reports')}}" class="">Reports</a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="typcntypcn-contacts"></span>Hello! <b>{{Auth::user()->name}}</b><span class="caret"></span></a>

                    </li>
                     <li><a href="{{url('auth/logout')}}" class="">Sign out</a></li>
                    @endif


            </ul>
    </nav>

    <div class="container">
       @yield('content')
      
      </div>

    <footer class="footer">
      <div class="container">
       <h6 class="text-center">Mimosa Mining Company &copy; 2016</h6>
      </div>
    </footer>

    <!-- UI Scripts -->
    <script type="text/javascript" src="{{ asset('/js/jQuery-2.1.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>


</body>
</html>
