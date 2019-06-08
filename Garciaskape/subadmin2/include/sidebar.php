<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="divider"></div>
		<ul class="nav menu">

		<?php if($page == 'dashboard') { ?>
			<li class="active"><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard </a></li>
		<?php } else { ?>
				<li><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard </a></li>
		<?php } ?>


		<?php if($page == 'reports') { ?>
			<li class="active"><a href="reports.php"><em class="fa fa-calendar">&nbsp;</em> Reports </a></li>
		<?php } else { ?>
				<li><a href="reports.php"><em class="fa fa-calendar">&nbsp;</em> Reports </a></li>
		<?php } ?>


		<?php if($page == 'stocks') { ?>
			<li class="active"><a href="stocks.php"><em class="fa fa-bar-chart">&nbsp;</em> Stocks </a></li>
		<?php } else { ?>
				<li><a href="stocks.php"><em class="fa fa-bar-chart">&nbsp;</em> Stocks </a></li>
		<?php } ?>


		<?php if($page == 'request') { ?>
			<li class="active"><a href="request.php"><em class="fa fa-toggle-off">&nbsp;</em> Request </a></li>
		<?php } else { ?>
				<li><a href="request.php"><em class="fa fa-toggle-off">&nbsp;</em> Request </a></li>
		<?php } ?>


		<?php if($page == 'customer') { ?>
			<li class="active"><a href="customer.php"><em class="fa fa-toggle-off">&nbsp;</em> Customer </a></li>
		<?php } else { ?>
				<li><a href="customer.php"><em class="fa fa-toggle-off">&nbsp;</em> Customer </a></li>
		<?php } ?>


		<?php if($page == 'others') { ?>
			<li class="active"><a href="others.php"><em class="fa fa-clone">&nbsp;</em> Others </a></li>
		<?php } else { ?>
				<li><a href="others.php"><em class="fa fa-clone">&nbsp;</em> Others </a></li>
		<?php } ?>

			<li><a href="../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->