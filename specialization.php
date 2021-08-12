<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[specialization_id])
	{
		$SQL="SELECT * FROM specialization WHERE specialization_id = $_REQUEST[specialization_id]";
		$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
		$data=mysqli_fetch_assoc($rs);
	}
?> 

	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1">
			<div class="contact">
				<h4 class="heading colr"><?=$heading?>Add Your Specialization</h4>
				<?php
				if($_REQUEST['msg']) { 
				?>
				<div class="msg"><?=$_REQUEST['msg']?></div>
				<?php
				}
				?>
				<form action="lib/specialization.php" enctype="multipart/form-data" method="post" name="frm_specialization">
					<ul class="forms">
						<li class="txt">Specialization Name</li>
						<li class="inputfield"><input name="specialization_name" id="specialization_name" type="text" class="bar" required value="<?=$data[specialization_name]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Total Experience</li>
						<li class="inputfield"><input name="specialization_experience" id="specialization_experience" type="text" class="bar" required value="<?=$data[specialization_experience]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Duration</li>
						<li class="inputfield"><input name="specialization_duration" id="specialization_duration" type="text" class="bar" required value="<?=$data[specialization_duration]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Specialization Fees</li>
						<li class="inputfield"><input name="specialization_fees" id="specialization_fees" type="text" class="bar" required value="<?=$data[specialization_fees]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Specialization Description</li>
						<li class="textfield"><textarea name="specialization_description" cols="" rows="4" required style="width:300px; height:70px"><?=$data[specialization_description]?></textarea></li>
					</ul>
					<ul class="forms">
						<li class="txt">Image</li>
						<li class="inputfield"><input name="specialization_image" type="file" class="bar"/></li>
					</ul>
					<div style="clear:both"></div>
					<ul class="forms">
						<li class="txt">&nbsp;</li>
						<li class="textfield"><input type="submit" value="Submit" class="simplebtn"></li>
						<li class="textfield"><input type="reset" value="Reset" class="resetbtn"></li>
					</ul>
					<input type="hidden" name="act" value="save_specialization">
					<input type="hidden" name="avail_image" value="<?=$data[specialization_image]?>">
					<input type="hidden" name="specialization_id" value="<?=$data[specialization_id]?>">
				</form>
			</div>
		</div>
		<div class="col2">
			<?php include_once("includes/sidebar.php"); ?> 
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 
