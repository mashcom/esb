
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Mimosa Mining Company</title>

		<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/cover.css') }}" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
    <body>

    <div class="site-wrapper">
      <div class="progress">
        <div class="progress-bar active progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"><span class="sr-only">60% Complete</span>Project Progress: 60% Complete</div>
      </div>

      <div class="site-wrapper-inner">

        <div class="cover-container">


          <div class="inner cover">
            <h1 class="cover-heading">Mimosa ESB System Prototype</h1>
            <p class="lead">To ensure quality compliance and timely payments. The project is locked, to activate project enter the key below:</p>
            <form class="form" action="{{url('/secret/complete')}}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="input-group input-group-lg">
                    <input type="text" name="code" class="form-control" placeholder="enter key here" autofocus="">
                    <span class="input-group-btn">
                      <button class="btn" type="submit"><i class="fa fa-unlock"></i> Unlock!</button>
                    </span>
                </div>

            </form>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>Locker by Blessing Mashoko (http://mashcom.github.io) &copy; 2016</p>
            </div>
          </div>

        </div>

      </div>

    </div>
    <style media="screen">
      .progress{
        z-index: 1000000;
    position: fixed;
    top: 0;
    width: 100%;
      }
    </style>
		<!-- UI Scripts -->
    <script type="text/javascript" src="{{ asset('/js/jQuery-2.1.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
  </body>
</html>
