<?php
if(isset($_POST['profileID'])){
include_once "connect.php";
  // collect value of input field
  $profileID = $_POST['profileID']; 
  $lastname = $_POST['lastname'];
  $firstname = $_POST['firstname'];
  $middlename = $_POST['middlename'];
  $address = $_POST['address'];

  if($profileID!=0){
	  $sql = "UPDATE tbl_profile
			SET lastname = '$lastname', firstname = '$firstname',middlename='$middlename',address='$address'
			WHERE profileID=$profileID";
  }else{
  	$sql = "INSERT INTO tbl_profile (lastname,firstname,middlename,address)
           VALUES('$lastname','$firstname','$middlename','$address')";  	
  }


	if ($con->query($sql) === TRUE) {
	  echo "Saved successfully";
	} else {
	  echo "Error: " . $sql . "<br>" . $con->error;
	}

	$con->close();
}
?>