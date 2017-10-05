<!DOCTYPE html>
<html lang="en">

	<head>

		@include('layouts.css+title')

		@yield('css')

	</head>

	<body>

	    <div id="wrapper">

	    	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	        	
        		@include('layouts.nav')

	        </nav>

	       	@yield('content')

	    </div>

	    @include('layouts.script')

	    @yield('script')

	</body>

</html>