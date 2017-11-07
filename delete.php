<?php

$conn = mysqli_connect("localhost","root","","angular_crud");

$data = json_decode(file_get_contents("php://input"));

$result_array=array();
if(count($data)>0)
{
	$id = $data->id;
	$query = "DELETE FROM tbl_user WHERE id = '$id'";

	if(mysqli_query($conn , $query))
	{
		$result_array['status']=True;
		$result_array['msg']="deleted successfully";
	}
	else
	{
		$result_array['status']=false;
		$result_array['msg']="Error while deleting data";
	}
}

echo json_encode($result_array);
 ?>