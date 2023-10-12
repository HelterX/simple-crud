<br>
<div>
		<table border="1" width="75%" class="table table-hover table-bordered">
			<tr>
				<th>ID</th>
				<th>Lastname</th>
				<th>Firstname</th>
				<th>Middlename</th>
				<th>Address</th>
				<th>Action</th>
			</tr>
<?php
	include_once "connect.php";
    $sql_profile = "SELECT * FROM tbl_profile";
    $result_profile = mysqli_query($con, $sql_profile);

    if (mysqli_num_rows($result_profile) > 0) {
        while($row = mysqli_fetch_array($result_profile)) {
        	echo "<tr>";
	        	echo "<td>".$row['profileID']."</td>";
	        	echo "<td>".$row['lastname']."</td>";
	        	echo "<td>".$row['firstname']."</td>";
	        	echo "<td>".$row['middlename']."</td>";
	        	echo "<td>".$row['address']."</td>";
	        	echo "<td>";
	        		echo "<a href='#' id='".$row['profileID']."' class='edit-profile btn btn-outline-warning' data-bs-toggle='modal' data-bs-target='#profile-modal'>Edit</a>";

	        		echo " <a href='#' id='".$row['profileID']."' class='delete-profile btn btn-outline-danger' data-bs-toggle='modal' data-bs-target='#profile-modal-delete'>Delete</a>";
	        	echo "</td>";
        	echo "</tr>";
       }
    }
?>
		</table>
</div>

<script type="text/javascript">
	//when Edit link is clicked
      $(".edit-profile").click(function(){
        $("#m-title").text("Edit profile");
        $("#b-save").val("Save Changes");
              
        var profileID =  $(this).attr("id");
        $.ajax({
            type:"POST", 
            url: "fetch-edit-profile.php",   
            data:{profileID:profileID},
            cache:false,
            dataType:"JSON",
            success:function(data) {

              $('#profileID_e').val(data.profileID);
              $('#lastname_e').val(data.lastname);
              $('#firstname_e').val(data.firstname);
              $('#middlename_e').val(data.middlename);
              $('#address_e').val(data.address);
            }
          });
      });
	//when Add record is clicked
      $(".add-record").click(function(){
        $("#m-title").text("Register profile");
        $("#b-save").val("Save");
        $("#profile-form")[0].reset();      
       
      });
        //when delete icon is clicked
      $(".delete-profile").click(function(){
        var profileID =  $(this).attr("id");
        //alert(profile_ID);
        $("#to-delete").text("Profile ID: "+profileID);

        $(".btn-delete").click(function(){
          $.ajax({
            url:'delete-profile.php',   // backend file: where your codes for saving were written.
            method:'POST',
            data: {profileID:profileID},
            success: function(response){ 
              $.ajax({
                  type:"POST", 
                  url: "fetch-profile.php",   
                  data:{},
                  cache:false,
                  success:function(data) {
                    $("#list-profile").html(data);
                  }
                });
            }
          });
        });
      });

</script>