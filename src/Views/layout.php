<!DOCTYPE html>
<html>

	<head>
		<title>Test</title>

		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <link rel="stylesheet" href="/bootstrap-4.1.2-dist/css/bootstrap.min.css"/>
	    <link rel="stylesheet" href="/jquery/jquery-ui/jquery-ui.min.css"/>
	    <style type="text/css">
	    	html, body {
	    		height: 100%;
	    		font-family: Optima,Segoe,"Segoe UI",Candara,Calibri,Arial,sans-serif
	    	}
	    	body {
 				display: flex;
  				flex-direction: column;
			}
			.content {
  				flex: 1 0 auto;
			}
			footer {
  				flex-shrink: 0;
  				min-height: 100px; 
  				background-color: #809fad;
			}
			header {
				margin-bottom: 50px;
				min-height: 100px; 
  				background-color: #809fad;
			}
			small {
				color:red;
				margin-left: 5px;
			}
	    	.main-title {
	    		margin-top: 15px;
	    		color: #eee;
	    	}
	    	.index-container a, .index-container a:hover {
	    		color: #212529;
	    		text-decoration: none;
	    	}
	    	.navbar {
	    		z-index: 5;
	    	}
	    	.cancel-button {
	    		margin-left: 25px;
	    	}
	    	.property-list {
	    		border:1px solid #eee; 
	    		padding:5px;
	    		margin-bottom: 15px;
	    	}
	    	.m-botton-25 {
	    		margin-bottom: 25px;
	    	}
	    	.m-bottom-15 {
	    		margin-bottom: 15px;
	    	}
	    </style>
	</head>

	<body>
		<header>
			<div class="container">
				<div class="main-title">
					<h2>Real Estate Sales</h2>
				</div>
			</div>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container">
				  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				    	<span class="navbar-toggler-icon"></span>
				  	</button>
				  	<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				    
				    	<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				      		<li class="nav-item <?php echo ($class == 'Index')? 'active' : ''; ?>">
				        		<a class="nav-link" href="/">Home</a>
				      		</li>
				      		<li class="nav-item <?php echo ($class == 'Sales')? 'active' : ''; ?>">
				        		<a class="nav-link" href="/Sales">Sales</a>
				      		</li>
				      		<li class="nav-item <?php echo ($class == 'Realestate')? 'active' : ''; ?>">
				        		<a class="nav-link disabled" href="/Realestate">Real Estate</a>
				      		</li>
				    	</ul>
			  		</div>
				</div>
			</nav>
		</header>
		
		<div class="container content">
  				<?php include($class . "/" . $func . ".php"); ?>
		</div>
		
		<footer>
			
		</footer>

		<script src="/jquery/jquery-3.3.1.min.js"></script>
		<script src="/jquery/jquery-ui/jquery-ui.min.js"></script>
    	<script src="/bootstrap-4.1.2-dist/js/bootstrap.min.js"></script>
	</body>
</html>