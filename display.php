<?php

$conn =  mysqli_connect("localhost","root","","angular_crud");
 $output = array();
$query = "SELECT * FROM tbl_user";

$results = mysqli_query($conn , $query);

if(mysqli_num_rows($results) > 0)
{
	while ($row = mysqli_fetch_array($results)) {
	 $output[] = array("id"=>$row['id'],"name"=>$row['name'],"email"=>$row['email'],'age'=>$row['age'],'gender'=>$row['gender']);
}

  echo  json_encode($output);

}
 ?>