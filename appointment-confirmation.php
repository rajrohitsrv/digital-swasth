<?php 
	include_once("includes/header.php"); 
	if($_SESSION['user_details']['user_level_id'] == 3) {
		if($_REQUEST[appointment_id]) {
			$SQL="SELECT * FROM `user`, `specialization`, `appointment` WHERE user_id = appointment_user_id AND appointment_id = ".$_REQUEST[appointment_id];
			$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
			$data=mysqli_fetch_assoc($rs);
		}
	}
	if($_SESSION['user_details']['user_level_id'] == 2) {
		if($_REQUEST[appointment_id]) {
			$SQL="SELECT * FROM `user`, `specialization`, `appointment` WHERE user_id = specialization_doctor_id AND specialization_id = appointment_specialization_id AND appointment_id = ".$_REQUEST[appointment_id];
			$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
			$data=mysqli_fetch_assoc($rs);
		}
	}

?>
<style>
th {
	height:30px;
	background-color:#666666;
	color:#FFFFFF;
}
.book_app {
    text-align: right;
    background: #FF0000;
    float: right;
    color: #FFFFFF;
    padding: 10px;
    margin-right: 5px;
    margin-bottom: 11px;
    font-weight: bold;
}
</style>
 <div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1">
			<div class="static">
				<h4 class="heading colr">Appointment Confirmation</h4>
				<?php
			if($_REQUEST['msg']) { 
			?>
				<div class="msg"><?=$_REQUEST['msg']?></div>
			<?php
			}
			?>
			  <div class="form-group" style="color:#000000; font-size:20px">
				  Dear <?=$_SESSION['user_details']['user_name']?>,<br>
				  This is the confirmation of the your appointment #<?=$data['appointment_id']?> has been successfully placed on date <?=$data['appointment_date']?>.<br><br>
			  </div>
			  <div id="myrow">
				<table>
						<tr>
							<th>Specialization ID</th>
							<td><?=$data[specialization_id]?></td>
						</tr>
						<tr>
							<th>Specialization Name</th>
							<td><?=$data[specialization_name]?></td>
						</tr>
						<tr>
							<th>Specialization Duration</th>
							<td><?=$data[specialization_duration]?></td>
						</tr>
						<tr>
							<th>Specialization Fees</th>
							<td><?=$data[specialization_fees]?></td>
						</tr>
						<tr>
							<th>Appointment Date</th>
							<td><?=$data[appointment_date]?></td>
						</tr>
						<tr>
							<th>Appointment Name</th>
							<td><?=$data[user_name]?></td>
						</tr>
						<tr>
							<th>Contact</th>
							<td><?=$data[user_mobile]?></td>
						</tr>
						<tr>
							<th>Email</th>
							<td><?=$data[user_email]?></td>
						</tr>
					</table>
				</div>
			</form>
			<div style="clear:both; height:20px;"></div>
			<?php
				$SQL="SELECT * FROM `report` WHERE report_appointment_id = ".$_REQUEST[appointment_id];
				$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
				$data=mysqli_fetch_assoc($rs);
			?>
			<h4 class="heading colr">Appointment Reports and Details</h4>
			<a href="report.php?appointment_id=<?=$_REQUEST[appointment_id]?>"><div class="book_app">Upload Reports</div></a>
			<form name="frm_appointment" action="lib/appointment.php" method="post">
				<div class="static">
				<table class="table table-striped table-advance table-hover" id="mydatatable" style="color:#000000; width:100%" width="100%">
					<thead>
						<tr class="tablehead bold">
						<td scope="col">ID</td>
						<td scope="col">Title</td>
						<td scope="col">Date</td>
						<td scope="col">Action</td>
						</tr>
					</thead>
					<tbody>
					<?php 
					$sr_no=1;
					while($data = mysqli_fetch_assoc($rs))
					{
					?>
					  <tr>
						<td><?=$data[report_id]?></td>
						<td><?=$data[report_name]?></td>
						<td><?=$data[report_date]?></td>
						<td style="text-align:center">
							<a style="color:#FF0000; font-weight:bold; text-decoration:underline" href="<?='uploads/'.$data[report_image]?>" target="_blank">View Report</a>
						</td>
						</td>
					  </tr>
					<?php } ?>
					</tbody>
					</table>
				</div>
				<input type="hidden" name="act" />
				<input type="hidden" name="appointment_id" />
			</form>
			</div>
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 
