<!DOCTYPE html>
<html>
    <head>
        <title>Property manipulation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="language" content="english"> 
        <!-- Bootstrap -->
        <link href="<?php echo BASE_URL . '/css/bootstrap.min.css'; ?>" rel="stylesheet" media="screen">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../../assets/js/html5shiv.js"></script>
          <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo BASE_URL . '/js/bootstrap.min.js'; ?>"></script>
        <div class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Test app</a>
                </div>
                <?php $request = new Request(); ?>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li <?php echo $request->getActive('index'); ?>><a href="/">Home</a></li>
                        <li <?php echo $request->getActive('add'); ?>><a href="/add">Add property</a></li>
                        <li <?php echo $request->getActive('about'); ?>><a href="/about">About</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="container">
            <?php echo $this->content; ?>
        </div>
    </body>
</html>