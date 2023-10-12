<?php
if(isset($_POST['profileID'])){
include_once "connect.php";
  // collect value of input field
  $profileID = $_POST['profileID']; 

	  $sql = "DELETE FROM tbl_profile
			WHERE profileID=$profileID";



	if ($con->query($sql) === TRUE) {
	  echo "Deleted successfully";
	} else {
	  echo "Error: " . $sql . "<br>" . $con->error;
	}

	$con->close();
}
?>