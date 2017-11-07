<?php

$conn = mysqli_connect("localhost","root","","angular_crud");

$result_array=array();

$data = json_decode(file_get_contents("php://input"));

$name = $conn->real_escape_string($data->name);
$email = $conn->real_escape_string($data->email);
$age = $conn->real_escape_string($data->age);
$gender = $conn->real_escape_string($data->gender);


$btn_name = $data->btnname;

if($btn_name == "insert")
{
	$query = "INSERT INTO tbl_user(name , email , age , gender) VALUES ('$name','$email','$age','$gender')";
	if(mysqli_query($conn , $query))
	{
		$result_array['status']=True;
	    $result_array['msg']="Inserted successfully";
	}
	else
	{
		$result_array['status']=false;
	    $result_array['msg']="Not Inserted successfully";
	}
}
if($btn_name == 'update')
{
	  $id = $data->id;
    	$query = "UPDATE tbl_user SET name ='$name',email='$email' , age='$age',gender='$gender' WHERE id = '$id'";
    	if(mysqli_query($conn , $query))
    	{
           $result_array['status']=True;
		    $result_array['msg']="updated successfully";
		}
		else
		{
			$result_array['status']=false;
		    $result_array['msg']="Not Updated successfully";
		}

}
 echo json_encode($result_array);

 ?>