<?php
	include_once("../includes/db_connect.php");
	include_once("../includes/functions.php");
	if($_REQUEST[act]=="save_report")
	{
		save_report();
		exit;
	}
	if($_REQUEST[act]=="delete_report")
	{
		delete_report();
		exit;
	}
	
	###Code for save report#####
	function save_report()
	{
		global $con;
		$R=$_REQUEST;		
		/////////////////////////////////////
		$image_name = $_FILES[report_image][name];
		$location = $_FILES[report_image][tmp_name];
		if($image_name!="")
		{
			move_uploaded_file($location,"../uploads/".$image_name);
		}
		else
		{
			$image_name = $R[avail_image];
		}				
		if($R[report_id])
		{
			$statement = "UPDATE `report` SET";
			$cond = "WHERE `report_id` = '$R[report_id]'";
			$msg = "Data Updated Successfully.";
		}
		else
		{
			$statement = "INSERT INTO `report` SET";
			$cond = "";
			$msg="Report Uploaded successfully.";
		}
		$SQL=   $statement." 
					`report_name` = '$R[report_name]', 
					`report_date` = '$R[report_date]', 
					`report_appointment_id` = '$R[report_appointment_id]', 
					`report_image` = '$image_name',
					`report_description` = '$R[report_description]'
					".
				 $cond;
		$rs = mysqli_query($con,$SQL) or die(mysqli_error($con));
		header("Location:../appointment-confirmation.php?appointment_id=$R[report_appointment_id]&msg=$msg");
	}
#########Function for delete report##########3
function delete_report()
{	
	global $con;
	/////////Delete the record//////////
	$SQL="DELETE FROM report WHERE report_id = $_REQUEST[report_id]";
	mysqli_query($con,$SQL) or die(mysqli_error($con));
	header("Location:../report-report.php?msg=Deleted Successfully.");
}
?>
