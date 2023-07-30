<?php
	include_once'inc/header.php';
	//include 'inc/slider.php';
?>
<?php 
$login_check = Session::get('customer_login');
   if($login_check== false){
   	header('Location:login.php');

   }
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
	    		<div class="heading">
	    		<h3>PROFILE CUSTOMERS</h3>
    		</div>
    		
 			<table class="tblone">
 				<?php
 				$id = Session::get('customer_id');
 				$get_customers = $cs -> show_customers($id);
 				if($get_customers)
 				{
 					while($result = $get_customers ->fetch_assoc())
 					{


 				?>
 				<tr>
 					<td>Name</td>
 					<td>:</td>
 					<td><?php echo $result['name'] ?></td>
 				</tr>
 				<tr>
 					<td>City</td>
 					<td>:</td>
 					<td><?php echo $result['city'] ?></td>
 				</tr>

 				<tr>
 					<td>Phone</td>
 					<td>:</td>
 					<td><?php echo $result['phone'] ?></td>
 				</tr>
 				<!-- <tr>
 					<td>Country</td>
 					<td>:</td>
 					<td><?php echo $result['country'] ?></td>
 				</tr> -->
 				<tr>
 					<td>Zipcode</td>
 					<td>:</td>
 					<td><?php echo $result['zipcode'] ?></td>
 				</tr>
 				<tr>
 					<td>Email</td>
 					<td>:</td>
 					<td><?php echo $result['email'] ?></td>
 				</tr>
 				<tr>
 					<td>Address</td>
 					<td>:</td>
 					<td><?php echo $result['address'] ?></td>
 				</tr>
 				<tr>
 					<td colspan="3"><a href="editprofile.php">Edit</a></td>
 				</tr>
 				<?php
 					}
 				}
 				?>
 			</table>
 		</div>
 	</div>
	</div>
	
   <?php
	include 'inc/footer.php';
?>
   