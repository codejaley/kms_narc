<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agrifood Consulting International</title>
	
    <!-- Bootstrap Core CSS -->
    <link href="/frontend_root/css/bootstrap.min.css" rel="stylesheet">
	<!-- Favicon -->
    <link rel="shortcut icon" href="/frontend_root/img/faviocn.ico"> 
    <!-- Start WOWSlider.com HEAD section -->
    <link rel="stylesheet" type="text/css" href="/frontend_root/slider/engine1/style.css" />
    <!-- Custom Fonts -->
    <link href="/frontend_root/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Custom CSS -->
    <link href="/frontend_root/css/agrifood.css" rel="stylesheet">
    <link href="/frontend_root/css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->	
	
 <!-- jQuery Version 1.11.0 -->
    <script src="/frontend_root/js/jquery-1.11.0.js"></script> 
    <!-- To Animate Page -->
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.4/waypoints.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/frontend_root/css/animate.css">
    
    <script type="text/javascript">//<![CDATA[ 
        $(function(){
					function onScrollInit( items, trigger ) {
						items.each( function() {
						var osElement = $(this),
							osAnimationClass = osElement.attr('data-os-animation'),
							osAnimationDelay = osElement.attr('data-os-animation-delay');
						  
							osElement.css({
								'-webkit-animation-delay':  osAnimationDelay,
								'-moz-animation-delay':     osAnimationDelay,
								'animation-delay':          osAnimationDelay
							});
		
							var osTrigger = ( trigger ) ? trigger : osElement;
							
							osTrigger.waypoint(function() {
								osElement.addClass('animated').addClass(osAnimationClass);
								},{
									triggerOnce: true,
									offset: '90%'
							});
						});
					}
		
					onScrollInit( $('.os-animation') );
					onScrollInit( $('.staggered-animation'), $('.staggered-animation-container') );
		});//]]>  

    </script>	
</head>	