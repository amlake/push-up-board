<html>
<head>
	<title><?php echo $title ?> - Push-Up Board</title>
	<link href="<?php echo base_url(); ?>assets/css/core.css" media="screen" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core.js"></script>
	<?php
		function debug_to_console( $data ) {

	    if ( is_array( $data ) )
	        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
	    else
	        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

	    echo $output;
		}
	?>
</head>
<body>
	<h1>Push-Up Board</h1>