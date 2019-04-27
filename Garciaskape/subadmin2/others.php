<?php $page = 'others'; ?>
<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>
<style>
th, td{
	padding: 10px;
}
</style>

<script type="text/javascript">
		function cloneRow(){
				var row = document.getElementById("dropdowns");
				var table = document.getElementById("tableDrop");
				var clone = row.cloneNode(true);
				clone.id = "dropdownsclone";
				table.appendChild(clone);
		}
		function RemoveOrder(){
			var rownumber = document.getElementById("tableDrop").rows.length;
			if (rownumber == 2){
				window.alert("You cannot remove the last order");
			}	else {
				var td = event.target.parentNode;
				var tr = td.parentNode;
				tr.parentNode.removeChild(tr);
			}
		}
</script>

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
				<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<div class="btn-group" role="group">
					  <button type="submit" class="btn btn-primary" name="spoil" id="spoil"> Spoilage </button>
					</div>
					<div class="btn-group" role="group">
					  <button type="submit" class="btn btn-primary" name="loss" id="loss"> Loss </button>
					</div>
					<div class="btn-group" role="group">
					  <button type="submit" class="btn btn-primary" name="return" id="return"> Return/Exchange </button>
					</div>
					<div class="btn-group" role="group">
					  <button type="submit" class="btn btn-primary" name="recon" id="recon"> Reconciliation </button>
					</div>
				</div>
				</form>
			</div>
			<br>

