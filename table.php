<?php include("partial/menu.php"); ?>
<?php
            session_start();
            if(!isset($_SESSION['AdminLoginId']))
            {
                header("location:admin_login.php");
            }
        ?>
<?php
      require_once('lib/function.php');
       $db = new db_functions();
	   
	   $flag = 0;
	   
	   if(isset($_GET['delete_id']))
	   {
		 $var_delete_id = $_GET['delete_id'];
		 
		   if($db->delete_user_record($var_delete_id))
		   {
			   $flag = 1;
		   }
		   else
		   {
			   $flag = 2;
		   }
		   
	   }
?>
<html>
<head>
<title>
</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>

<style>
		.deleted_msg
		{
			padding:10px;
			width:400px;
			margin:auto;
			text-align:center;
			background-color:#C8EFD4;
			font-family:cambria;
			font-size:25px;
			color:#333333;
			margin-bottom:25px;
			margin-top:25px;
			border-radius:5px;
		}
		.not_delete_msg
		{
			padding:15px;
			width:450px;
			margin:auto;
			text-align:center;
			background-color:#FBCFD0;
			font-family:cambria;
			font-size:25px;
			color:#333333;
			margin-bottom:20px;
			margin-top:20px;
			border-radius:5px;
		}
		.table_body{
			background: var(--light-gray-color);
			margin-top: 2%; 
			min-height:800px;
			border:1px solid;		
		}
		.table_head
		{
			width: 100%;
			height: 80px;	
			display:flex; 
			justify-content: space-between;
			align-items: center;
			border:1px solid;
			margin-bottom:10px;	
		}
		.table_head h1{
			
			text-align: center;
			margin-left: 17%;
		}
		.table_head button{
			font-size: 18px;
			font-weight: 550;
			padding: 8px 13px;
			border-radius: 10px;
			margin-right: 10px;
			border: 1px solid #f2f2f2;
		}
		.table_head button:hover{
			color: black;
			background-color: #f3961c;
			border-radius: 10px;
		}
</style>
</head>
	<body>
	<div class="table_body">
		<div class="table_head">
			<h1>Welcome To Cafee Contact Report-Admin <?php echo $_SESSION['AdminLoginId']; ?>
		     </h1>
			 <form method="POST">
                        <button class="button" name="logout">Logout</button>
                </form>
        	</div>
		<?php
				if(isset($_POST['logout']))
				{
					session_destroy();
					header("location:admin_login.php");		
				}
			?>
			<?php 
				if($flag==1)
				{
			?>		
					<div class="deleted_msg" >Data Deleted Successfully</div>
			<?php
				}
				else if($flag==2)
				{
			?>
				<div class="not_delete_msg">Deletion Failed</div>
			<?php
				}	
			?>

			<?php
				//echo   $_SESSION['edit_id'];
			?>

		<table border="0" cellspacing="25" cellpadding="1">
			<thead>
			<th>Sr.No</th>
			<th>Full_Name</th>
			<th>Email Id</th>
			<th>Mobile No</th>
			<th>Password</th>
			<th>Textarea</th>
			<th>Date</th>
			<th>Time</th>
			<th>Action</th>
			<th>Action</th>
			</thead>
			
			<tbody>
				<?php
					$response_data = array();
					$response_data = $db->get_user_data();
					
					//print_r($response_data);
					
					if(!empty($response_data))
					{
						$row = 0;
						foreach($response_data as $record)
						{
							$res_id       = $response_data[$row][0];
							$res_name     = $response_data[$row][1];
							$res_email    = $response_data[$row][2];
							$res_number   = $response_data[$row][3];
							$res_password = $response_data[$row][4];
							$res_textarea = $response_data[$row][5];
							$res_date     = $response_data[$row][6];
							$res_time     = $response_data[$row][7];
					?>
					
				<tr>
				<td><?php echo $row+1; ?></td>
				<td><?php echo $res_name; ?> </td>
				<td><?php echo $res_email; ?> </td>
				<td><?php echo $res_number; ?> </td>
				<td><?php echo $res_password; ?> </td>
				<td><?php echo $res_textarea; ?> </td>
				<td><?php echo $res_date; ?> </td>                                 
				<td><?php echo $res_time; ?> </td>
				<td>
					<a href="table.php?delete_id=<?php echo $res_id;  ?>">Delete</a>
				</td>
				<td> 
					<a href="editpage.php?edit_id=<?php echo $res_id; ?>">Edit</a>
				
				</td>
			</tr>
					
					<?php
							$row++;
						}     
					}
						else
					{
						echo"NO DATA FOUND";
					} 
				
				?>
			</tbody>
	
		</table>
	</div>
	<!-- footer section -->
	</body>
</html>