<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NARC :: Knowledge Management System</title>

    <!-- Bootstrap Core CSS -->
    <link href="/frontend_root/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/frontend_root/css/modern-business.css" rel="stylesheet">
    <link rel="stylesheet" href="/frontend_root/css/bootstrap-select.css">
    <link rel="stylesheet" href="/frontend_root/css/narc.css">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- DataTables CSS -->
	<link rel="stylesheet" type="text/css" href="/frontend_root/DataTables/media/css/jquery.dataTables.css">
    <link rel="icon" type="icon" href="/images/favicon.ico">
		
    <!-- jQuery -->
    <script src="/frontend_root/js/jquery.js"></script>
	
	<!-- DataTables -->
	<script type="text/javascript" charset="utf8" src="<?php echo URL::to('../');?>/public/frontend_root/DataTables/media/js/jquery.dataTables.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="frontend_root/js/bootstrap.min.js"></script>
	<script src="/frontend_root/js/bootstrap-select.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
<script>
    $('.selectpicker').selectpicker({
        style: 'btn-info',
        size: 4
    });
</script>
</head>

<body>
<div class="container">
 @include('frontend.includes.header-top')	
	{{ $content }}
 @include('frontend.includes.footer-content')			

    </div>
    <!-- /.container -->


</body>

</html>
