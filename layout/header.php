<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Valuation Vision</title>

    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Bootstrap style -->
    <link href="/css/paper.bootstrap.min.css" rel="stylesheet">

    <!-- JS includes -->
    <script type="text/javascript" src="/js/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>

    <!-- Could move locally, but not necessary for task -->
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Valuation Vision</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav">
                <li><a href="/property/index.php"><strong>All Properties</strong></a></li>
                <li><a href="/property/add.php"><strong>Add Property</strong></a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="hidden-xs col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">New Properties</h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <?php
                            foreach (Properties::get_recent() as $row) {
                                echo '<li class="list-group-item"><a href="/property/view.php?property_id='.$row['id'].'"><i class="fa fa-ellipsis-v" style="color: #4285F4;"></i> '.$row['address'].'<br /><i class="fa fa-ellipsis-v" style="color: #4285F4;"></i> '.$row['city'].', '.$row['state'].' '.$row['zip'].'</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">