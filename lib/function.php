<?php
	//Session Start
    session_start();
	
	//Set indian timzone for date and time
	date_default_timezone_set('Asia/kolkata');
		
//Class Define	
class db_functions
{
	function __construct()
	{
		//Database connection
		$this->con = mysqli_connect("localhost","root","","bachelor's_cafee");
		if(mysqli_connect_error())
	{
		echo "cannot connect";
	}
	
	}
	
	function registration_data($var_name, $var_email, $var_number,$var_password,$var_textarea)
{
    $date = date("Y-m-d");
    $time = date("h:i:s a");
    
    // Corrected SQL query with proper column names
    if($stmt = $this->con->prepare("INSERT INTO `contact_us` (`name`, `email`, `number`, `password`, `textarea`, `date`, `time`) VALUES (?, ?, ?, ?, ?, ?, ?)"))
    {
        $stmt->bind_param("sssssss", $var_name, $var_email, $var_number,$var_password,$var_textarea, $date, $time);
        
        if($stmt->execute())
        {
            return true;
        }
        return false;
    }
}
//table data
  function get_user_data()
  {
	 if($stmt = $this->con->prepare("SELECT `id`, `name`, `email`, `number`,`password`, `textarea`, `date`, `time` FROM `contact_us`"))
	 {
		 $stmt->bind_result($res_id,$res_name,$res_email,$res_number,$res_password,$res_textarea,$res_date,$res_time);
		 if($stmt->execute())
		 {
			 $data = array();
			 $row = 0; 
			 
			 while($stmt->fetch())
			 {
				 $data[$row][0] = $res_id;
				 $data[$row][1] = $res_name;
				 $data[$row][2] = $res_email;
				 $data[$row][3] = $res_number;
				 $data[$row][4] = $res_password;
				 $data[$row][5] = $res_textarea;
				 $data[$row][6] = $res_date;
				 $data[$row][7] = $res_time;
				 
				 $row++;
				 
			 }
			 if(!empty($data))
			 {
				 return $data;
			 }
			 	return false; 
		 }
	 }

  }
  //delete data
  function delete_user_record($delete_id)
  {
	 $stmt = $this->con->prepare("DELETE FROM `contact_us` WHERE `id`=?");
	 {
		$stmt->bind_param("i",$delete_id); 
	 }
	 if($stmt->execute())
	 {
		 return true;
	 }
	 return false;
	  
  }
  //editpage 
function update_user_record($var_name,$var_email,$var_number,$var_password,$var_textarea,$var_edit_id)
  {
	  if($stmt = $this->con->prepare("UPDATE contact_us SET name=?,email=?,number=?,password=?,textarea=? WHERE id=?"))
	  {
		  $stmt->bind_param("sssssi",$var_name,$var_email,$var_number,$var_password,$var_textarea,$var_edit_id);
		  
		  if($stmt->execute())
		  {
			  return true;
		  }
		  return false;
	  }
  
  }
  //data showing in formm
  function get_user_data_from_id($var_edit_id)
  {
	  if($stmt = $this->con->prepare("SELECT `id`, `name`, `email`, `number`, `password`, `textarea`, `date`, `time` FROM `contact_us` where `id`=?"))
      {
		  $stmt->bind_param("i",$var_edit_id);
	
	      $stmt->bind_result($res_id,$res_name,$res_email,$res_number,$res_password,$res_textarea,$res_date,$res_time);
	  }
	  if($stmt->execute())
	  {
		  if($stmt->fetch())
		  {
			     $data = array();
			  
			     $data[0] = $res_id;
				 $data[1] = $res_name;
				 $data[2] = $res_email;
				 $data[3] = $res_number;
				 $data[4] = $res_password;
				 $data[5] = $res_textarea;
				 $data[6] = $res_date;
				 $data[7] = $res_time;
				 
				 return $data;	 
		  }
		  else
		  {
			  return false;
		  }
	  }
  }
  function get_password_from_number($var_number)
  {
	  if($stmt = $this->con->prepare("SELECT `password` FROM `contact_us` WHERE `number`=?"))
	  {
		  $stmt->bind_param("s",$var_number);
		  
		  $stmt->bind_result($res_password);
		  
		  if($stmt->execute())
		  {
			  if($stmt->fetch())
			  {
				  return $res_password;
			  }
			  else
			  {
				  return false;
			  }
			  
		  }
	  }
  }

}    //class bracket
?>
	