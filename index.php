<?php
include("admin/custom/static/general.php");
include("admin/static/general.php");

include("static/redirect.php");
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rumah Asuh</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo $prefix_url;?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $prefix_url;?>css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="<?php echo $prefix_url;?>script/html5shiv.js"></script>
      <script src="<?php echo $prefix_url;?>script/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo $prefix_url;?>script/modernizr-2.6.1.min.js"></script>
    <script src="<?php echo $prefix_url;?>script/jquery.js"></script>
    <?php //include($prefix_url."static/analytics.php"); ?>
  </head>
  <?php
    if($_REQUEST['act']=="shop_/details") {
      $body_class='products';
    }
    else if($_REQUEST['act']=="blog_/index") {
      $body_class='blog';
    }
  ?>
  <body class="<?php echo $body_class;?>">
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
    <![endif]-->

		<?php
		if(empty($_REQUEST['act'])){
		  include('pages_/home/index.php');
		}else{
		   include(str_replace ('http','',$_REQUEST['act']).".php");
		}
		?>

    <?php include("static/footer.php"); ?>

    <script src="<?php echo $prefix_url;?>script/bootstrap.js"></script>
    <script src="<?php echo $prefix_url;?>script/holder.js"></script>
    <script src="<?php echo $prefix_url;?>script/main.js"></script>

  </body>
</html>