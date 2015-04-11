<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Tmin10">

    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo conf::BASE_URL ?>css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo conf::BASE_URL ?>css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo conf::BASE_URL ?>js/html5shiv.js"></script>
      <script src="<?php echo conf::BASE_URL ?>js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
	
    <div class="container">
    <?php include_once 'system/views/'.$content_view ?>
    </div> <!-- /container -->

  </body>
</html>
