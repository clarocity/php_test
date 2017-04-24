<?php 
    require_once 'config.php';
    require_once 'Property.php';
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
            
            .marg-b10 { margin-bottom: 10px; }
            .required, .required-msg { font-weight: bold; color: red; }
            .required-msg { display:block; font-size: 80%; text-align: left; padding-left: 10px; } 
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Property Index</a>
          <a class="navbar-brand add-property" href="#">Add a Property</a>
        </div>
      </div>
    </nav>

    <div class="jumbotron">
      <div class="container" id="pgContainer">
        <h2>Clarocity Property List</h2>         
      </div>
    </div>

    <div class="container">
      <div class="pull-right marg-b10"><button class="btn btn-primary add-property"><i class="glyphicon glyphicon-plus-sign"></i> Add a Property</button></div>

      <table id="propertyList" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="">Address</th>
                <th class="">City</th>
                <th class="text-center">State</th>
                <th class="text-center">Zip</th>
                <th class="text-center">Times Sold</th>
                <th>Last Sale</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
      </table>

      <hr>

      <footer>
        <p>Copyright © <?php echo date('Y'); ?> Clarocity Sample Project. Developed by: <a href="http://www.mcwayweb.com">McWay Web Development</a></p>
      </footer>
    </div> 
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
