<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[report_id])
	{
		$SQL="SELECT * FROM report WHERE report_id = $_REQUEST[report_id]";
		$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
		$data=mysqli_fetch_assoc($rs);
	} else {
		$data[report_appointment_id] = $_REQUEST[appointment_id];
	}
?> 
<script>
jQuery(function() {
	jQuery( "#report_date" ).datepicker({
	  changeMonth: true,
	  changeYear: true,
	   yearRange: "-0:+1",
	   dateFormat: 'd MM,yy'
	});
});
</script>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1">
			<div class="contact">
				<h4 class="heading colr"><?=$heading?>Add Your Report</h4>
				<?php
				if($_REQUEST['msg']) { 
				?>
				<div class="msg"><?=$_REQUEST['msg']?></div>
				<?php
				}
				?>
				<form action="lib/report.php" enctype="multipart/form-data" method="post" name="frm_report">
					<ul class="forms">
						<li class="txt">Report Name</li>
						<li class="inputfield"><input name="report_name" id="report_name" type="text" class="bar" required value="<?=$data[report_name]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Date</li>
						<li class="inputfield"><input name="report_date" id="report_date" type="text" class="bar" required value="<?=$data[report_date]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Report Description</li>
						<li class="textfield"><textarea name="report_description" cols="" rows="4" required style="width:300px; height:70px"><?=$data[report_description]?></textarea></li>
					</ul>
					<ul class="forms">
						<li class="txt">Report File</li>
						<li class="inputfield"><input name="report_image" type="file" class="bar"/></li>
					</ul>
					<div style="clear:both"></div>
					<ul class="forms">
						<li class="txt">&nbsp;</li>
						<li class="textfield"><input type="submit" value="Submit" class="simplebtn"></li>
						<li class="textfield"><input type="reset" value="Reset" class="resetbtn"></li>
					</ul>
					<input type="hidden" name="act" value="save_report">
					<input type="hidden" name="avail_image" value="<?=$data[report_image]?>">
					<input type="hidden" name="report_id" value="<?=$data[report_id]?>">
					<input type="hidden" name="report_appointment_id" value="<?=$data[report_appointment_id]?>">
				</form>
			</div>
		</div>
		<div class="col2">
			<?php include_once("includes/sidebar.php"); ?> 
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 
