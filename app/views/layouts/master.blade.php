<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Entity Plugin</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="/assets/css/normalize.css">
        <link rel="stylesheet" href="/assets/css/main.css">
        
        <link href="/assets/css/bootstrap-theme-yeti.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
        
        <script src="/assets/js/vendor/modernizr-2.6.2.min.js"></script>
        
        @yield('styles')
        
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        
        <nav class="navbar navbar-inverse" role="navigation">
        	<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Entity Plugin</a>
				</div>
				
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						@if ( Auth::guest() )
							<li>{{ HTML::link('login', 'Sign In') }}</li>
						@else
							<li>{{ HTML::link('logout', 'Logout') }}</li>
						@endif
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container -->
        </nav>

        <!-- Add your site or application content here -->
        <!-- Success-Messages -->
		@if ($message = Session::get('success'))
		<div class="container">
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<b>Success:</b> {{{ $message }}}
			</div>
		</div>
		@endif
        @yield('content')

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/assets/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="/assets/js/plugins.js"></script>
        <script src="/assets/js/main.js"></script>
        
        <script src="/assets/js/bootstrap.min.js"></script>
        
        @yield('scripts')

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
    </body>
</html>
