<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	<link rel="stylesheet" href="/css/main.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans' rel='stylesheet' type='text/css'>
	  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  
  
  <script src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=6.3"></script>
  <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans' rel='stylesheet' type='text/css'>

</head>

<body>	
	
	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
	
</body>
</html>