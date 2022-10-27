<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
	<title>Imprimir Contrato</title>
	<!-- initiate head with meta tags, css and script -->
	@include('include.head')

</head>
<body id="app" >
    <div class="wrapper">
    	<!-- initiate header-->
    	@include('include.header')
    	<div class="page-wrap">
	    	<!-- initiate sidebar-->
	    	

	    	<div style="padding-left: 15px;" class="main-content">
	    		<!-- yeild contents here -->
	    		@yield('content')
	    	</div>
			
	    	<!-- initiate chat section-->
	    	@include('include.chat')


	    	<!-- initiate footer section-->
	    	@include('include.footer')

    	</div>
    </div>
    
	
</body>
</html>