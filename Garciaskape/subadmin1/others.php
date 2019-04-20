<?php $page = 'others'; ?>
<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>
<style>
table{
	background-color:rgba(0, 0, 0, 0);
}
</style>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Others </li>
			</ol>
		</div><!--/.row-->

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
				<h1 class="h2">Others</h1>
				<form action="others-process.php" method="POST">
				<div class="btn-group" role="group" aria-label="...">
					<button type="submit" class="btn btn-default" name="spoil" id="spoil">Spoilage</button>
					<button type="submit" class="btn btn-default" name="loss" id="loss">Loss</button>
					<button type="submit" class="btn btn-default" name="return" id="return">Return / Exchange</button>
					<button type="submit" class="btn btn-default" name="physical" id="physical">Physical Count??</button>
				</div>
				</form>
			</div>
			<br>

