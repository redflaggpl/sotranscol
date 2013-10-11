<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <title>Bootstrap Shopping Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php #echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>

    <div class="container">
		<div class="row"><!-- start header -->
			<div class="span4 logo">
			<a href="./Bootstrap Shopping Cart_files/Bootstrap Shopping Cart.htm">
				<h1>Bootstrap Cart</h1>
			</a>
			</div>
			<div class="span8">
			
				<div class="row">
					<div class="span1">&nbsp;</div>
					<div class="span2">
						<h4>Currency</h4>
						<a href="http://wbpreview.com/previews/WB00223R0/index.html#">USD</a> |
						<a href="http://wbpreview.com/previews/WB00223R0/index.html#"><strong>GBP</strong></a> |
						<a href="http://wbpreview.com/previews/WB00223R0/index.html#">EUR</a>
					</div>
					<div class="span2">
						<a href="http://wbpreview.com/previews/WB00223R0/cart.html"><h4>Shopping Cart (3)</h4></a>
						<a href="http://wbpreview.com/previews/WB00223R0/cart.html">2 item(s) - $40.00</a>
					</div>					
					<div class="span3 customer_service">
						<h4>FREE delivery on ALL orders</h4>
						<h4><small>Customer service: 0800 8475 548</small></h4>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="links pull-right">
						<?php echo CHtml::link("Home",array('/site'));?> |
						<?php echo CHtml::link(!Yii::app()->user->isGuest?'Logout ('.Yii::app()->user->name.')':"My Account",Yii::app()->user->isGuest?array('/site/login'):array('/site/logout'));?> |
						<?php echo CHtml::link("Shopping Cart",array('/site/page','view'=>'about'));?> |
						<?php echo CHtml::link("About",array('/site/page','view'=>'about'));?> |
						<?php echo CHtml::link("Contact",array('/site/contact'));?>
					</div>
				
				</div>
			</div>
		</div><!-- end header -->
		
		<div class="row"><!-- start nav -->
			<div class="span12">
			  <div class="navbar navbar-inverse">
					<div class="navbar-inner">
					  <div class="container" style="width: auto;">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						</a>
						<div class="nav-collapse">
						  <ul class="nav">
							  <li class="dropdown">
							  <a href="http://wbpreview.com/previews/WB00223R0/category.html" class="dropdown-toggle" data-toggle="dropdown">Desktops <b class="caret"></b></a>
							  <ul class="dropdown-menu">
								<li><a href="http://wbpreview.com/previews/WB00223R0/listings.html">PC</a></li>
								<li><a href="http://wbpreview.com/previews/WB00223R0/listings.html">Mac</a></li>
								<li class="divider"></li>
								<li class="nav-header">Accessories</li>
								<li><a href="http://wbpreview.com/previews/WB00223R0/listings.html">Keyboard</a></li>
								<li><a href="http://wbpreview.com/previews/WB00223R0/listings.html">Speakers</a></li>
							  </ul>
							</li>
							<li><a href="http://wbpreview.com/previews/WB00223R0/category.html">Laptops</a></li>

							<li><a href="http://wbpreview.com/previews/WB00223R0/category.html">Components</a></li>
							<li><a href="http://wbpreview.com/previews/WB00223R0/category.html">Tablets</a></li>
							<li class="dropdown">
							  <a href="http://wbpreview.com/previews/WB00223R0/category.html" class="dropdown-toggle" data-toggle="dropdown">Software <b class="caret"></b></a>
							  <ul class="dropdown-menu">
								<li><a href="http://wbpreview.com/previews/WB00223R0/listings.html">Business &amp; Office</a></li>
								<li><a href="http://wbpreview.com/previews/WB00223R0/listings.html">Children's Fun &amp; Learning</a></li>
								<li><a href="http://wbpreview.com/previews/WB00223R0/listings.html"> Digital Imaging</a></li>
								<li class="divider"></li>
								<li class="nav-header">PC Games</li>
								<li><a href="http://wbpreview.com/previews/WB00223R0/listings.html">Action &amp; Shooter</a></li>
								<li><a href="http://wbpreview.com/previews/WB00223R0/listings.html">Adventure</a></li>
								<li><a href="http://wbpreview.com/previews/WB00223R0/listings.html">Fighting</a></li>
							  </ul>
							</li>
							 <li><a href="http://wbpreview.com/previews/WB00223R0/listings.html">Phones &amp; PDAs</a></li>

						  </ul>

						  <ul class="nav pull-right">
						   <li class="divider-vertical"></li>
							<form class="navbar-search" action="">
								<input type="text" class="search-query span2" placeholder="Search">
								<button class="btn btn-primary btn-small search_btn" type="submit">Go</button>
							</form>
							
						  </ul>
						</div><!-- /.nav-collapse -->
					  </div>
					</div><!-- /navbar-inner -->
				</div><!-- /navbar -->
			</div>
		</div><!-- end nav -->	
			 <ul class="breadcrumb">
				<li>
				<a href="#">Home</a> <span class="divider">/</span>
				</li>
				<li>
				<a href="listings.html">Desktops</a> <span class="divider">/</span>
				</li>
				<li class="active">
				<a href="category.html">Mac</a>
				</li>
			</ul>
			
		<?php echo $content;?>
	<footer>
		<hr>
	<div class="row well no_margin_left">

	<div class="span3">
		<h4>Information</h4>
		<ul>
			<li><a href="http://wbpreview.com/previews/WB00223R0/two-column.html">About Us</a></li>
			<li><a href="http://wbpreview.com/previews/WB00223R0/typography.html">Delivery Information</a></li>
			<li><a href="http://wbpreview.com/previews/WB00223R0/typography.html">Privacy Policy</a></li>
			<li><a href="http://wbpreview.com/previews/WB00223R0/typography.html">Terms &amp; Conditions</a></li>
		</ul>
	</div>
	<div class="span3">
		<h4>Customer Service</h4>
		<ul>
			<li><a href="http://wbpreview.com/previews/WB00223R0/contact.html">Contact Us</a></li>
			<li><a href="http://wbpreview.com/previews/WB00223R0/typography.html">Returns</a></li>
			<li><a href="http://wbpreview.com/previews/WB00223R0/typography.html">Site Map</a></li>
		</ul>
	</div>
	<div class="span3">
		<h4>Extras</h4>
		<ul>
			<li><a href="http://wbpreview.com/previews/WB00223R0/typography.html">Brands</a></li>
			<li><a href="http://wbpreview.com/previews/WB00223R0/typography.html">Gift Vouchers</a></li>
			<li><a href="http://wbpreview.com/previews/WB00223R0/typography.html">Affiliates</a></li>
			<li><a href="http://wbpreview.com/previews/WB00223R0/typography.html">Specials</a></li>
		</ul>
	</div>
	<div class="span2">
		<h4>My Account</h4>
		<ul>
			<li><a href="http://wbpreview.com/previews/WB00223R0/my_account.html">My Account</a></li>
			<li><a href="http://wbpreview.com/previews/WB00223R0/typography.html">Order History</a></li>
			<li><a href="http://wbpreview.com/previews/WB00223R0/typography.html">Wish List</a></li>
			<li><a href="http://wbpreview.com/previews/WB00223R0/typography.html">Newsletter</a></li>
		</ul>
	</div>

</div></footer>

</div> <!-- /container -->

<div id="shadowMeasureIt"></div>
<div id="divCoordMeasureIt"></div>
<div id="divRectangleMeasureIt">
<div id="divRectangleBGMeasureIt"></div></div>
</body></html>