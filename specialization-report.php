<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php"); 
	$SQL="SELECT * FROM `specialization` WHERE specialization_doctor_id = ".$_SESSION['user_details']['user_id'];
	$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
?>
<script>
function delete_specialization(specialization_id)
{
	if(confirm("Do you want to delete the specialization?"))
	{
		this.document.frm_specialization.specialization_id.value=specialization_id;
		this.document.frm_specialization.act.value="delete_specialization";
		this.document.frm_specialization.submit();
	}
}
jQuery(document).ready(function() {
	jQuery('#mydatatable').DataTable();
});
</script>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1" style="width:100%">
		<div class="contact">
			<h4 class="heading colr">Specialization Report</h4>
			<?php
			if($_REQUEST['msg']) { 
			?>
				<div class="msg"><?=$_REQUEST['msg']?></div>
			<?php
			}
			?>
			<form name="frm_specialization" action="lib/specialization.php" method="post">
				<div class="static">
				<table class="table table-striped table-advance table-hover"  id="mydatatable" style="specialization:#000000">
					<thead>
						<tr class="tablehead bold">
						<td scope="col">ID</td>
						<td scope="col">Image</td>
						<td scope="col">Specialization Name</td>
						<td scope="col">Duration</td>	
						<td scope="col">Fees</td>								
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
						<td><?=$data[specialization_id]?></td>
						<td><img src="<?='uploads/'.$data[specialization_image]?>" style="heigh:50px; width:50px"></td>
						<td><?=$data[specialization_name]?></td>
						<td><?=$data[specialization_duration]?></td>
						<td><?=$data[specialization_image]?></td>
						<td style="text-align:center">
							<a href="specialization.php?specialization_id=<?php echo $data[specialization_id] ?>">Edit</a> | <a href="Javascript:delete_specialization(<?=$data[specialization_id]?>)">Delete</a> 
						</td>
						</td>
					  </tr>
					<?php } ?>
					</tbody>
					</table>
				</div>
				<input type="hidden" name="act" />
				<input type="hidden" name="specialization_id" />
			</form>
		</div>
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 
