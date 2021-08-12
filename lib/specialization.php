<?php
	include_once("../includes/db_connect.php");
	include_once("../includes/functions.php");
	if($_REQUEST[act]=="save_specialization")
	{
		save_specialization();
		exit;
	}
	if($_REQUEST[act]=="delete_specialization")
	{
		delete_specialization();
		exit;
	}
	
	###Code for save specialization#####
	function save_specialization()
	{
		global $con;
		$R=$_REQUEST;		
		/////////////////////////////////////
		$image_name = $_FILES[specialization_image][name];
		$location = $_FILES[specialization_image][tmp_name];
		if($image_name!="")
		{
			move_uploaded_file($location,"../uploads/".$image_name);
		}
		else
		{
			$image_name = $R[avail_image];
		}				
		if($R[specialization_id])
		{
			$statement = "UPDATE `specialization` SET";
			$cond = "WHERE `specialization_id` = '$R[specialization_id]'";
			$msg = "Data Updated Successfully.";
		}
		else
		{
			$statement = "INSERT INTO `specialization` SET";
			$cond = "";
			$msg="Data saved successfully.";
		}
		$SQL=   $statement." 
					`specialization_name` = '$R[specialization_name]', 
					`specialization_doctor_id` = '".$_SESSION['user_details']['user_id']."', 
					`specialization_experience` = '$R[specialization_experience]', 
					`specialization_duration` = '$R[specialization_duration]', 
					`specialization_fees` = '$R[specialization_fees]', 
					`specialization_image` = '$image_name',
					`specialization_description` = '$R[specialization_description]'
					".
				 $cond;
		$rs = mysqli_query($con,$SQL) or die(mysqli_error($con));
		header("Location:../specialization-report.php?msg=$msg");
	}
#########Function for delete specialization##########3
function delete_specialization()
{	
	global $con;
	/////////Delete the record//////////
	$SQL="DELETE FROM specialization WHERE specialization_id = $_REQUEST[specialization_id]";
	mysqli_query($con,$SQL) or die(mysqli_error($con));
	header("Location:../specialization-report.php?msg=Deleted Successfully.");
}
?>
