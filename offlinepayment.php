<?php
	include_once'inc/header.php';
	//include 'inc/slider.php';
?>
<?php 
   //  if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
   //  	echo "<script>window.location= '404.php' </script>";
   //  }else {
   //  	$id = $_GET['proid'];
   //  }


   // if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
   // 	$quantity = $_POST['quantity'];
   // 	$addToCart = $ct->add_to_cart($quantity, $id);
   // }
   
?>
<style >
	.box-left {
		width: 50%;
		border: 1px solid #666;
		float: left;
		padding: 4px;
	}
	.box-right {
		width: 46%;
		border: 1px solid #666;
		float: right;
		padding: 4px;
	}
	input.submit-order{
		padding: 10px 70px;
		border: none;
		background: red;
		font-size: 25px;
		color: #fff;
		border-radius: 10px;
		margin: 10px;
		align: center;
		cursor: pointer;
	}
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		
		<div class="heading">
    		<h3> OFFLINE PAYMENT METHOD</h3>
		</div>
		<div class="clear">
			
		</div>
		<div class="box-left">
			<div class="cartpage">
			    	<h4>Your Cart</h4>
			    	<?php
			    	if(isset($update_quantity_cart)){
			    		echo $update_quantity_cart;
			    	}
			    	?>
			    	<?php
			    	if(isset($del_pro_cart)){
			    		echo $del_pro_cart;
			    	}
			    	?>
						<table class="tblone">
							<tr>
								<th width="10%">ID</th>
								<th width="20%">Product Name</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								
							</tr>
							<?php
							$get_product_cart = $ct->get_product_cart();
							if($get_product_cart){
								$subtotal = 0;
								$qty= 0;
								$i = 0;
								while($result = $get_product_cart->fetch_assoc())
								{
									$i++;
							?>
							<tr>
								<td> <?php echo $i; ?></td>
								<td> <?php echo $result['productName']?></td>
								<td> <?php $result['price'].' '.'VND'?></td>
								<td>
									<?php echo $result['quantity']?></td>
								</td>
								<td><?php
									$total = $result['price'] * $result['quantity'];
									echo $total.' '.'VND';
								?></td>
								
							</tr>
							<?php
								$subtotal += $total;
								$qty =$qty + $result['quantity'];
								$vat = $subtotal * 0.1;
								$grandtotal = $subtotal + $vat;
								}	
							}
							?>
							
							<?php
								if($check_cart){

							?>

							
						</table>
						<table style="float:right;text-align:left; margin: 5px;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php 

										echo $subtotal.' '.'VND';
										Session::set('sum',$subtotal); 
										Session::set('qty', $qty);
										?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%(<?php echo $vat = $subtotal * 0.1;?>)</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								 <td><?php echo $grandtotal.' '.'VND';?> </td> 
							</tr>
							
					   </table>
					   <?php
							}else{
								echo 'Your Cart is Empty!';
							}
					   ?>
					
					</div>
					
    	</div>  
    	<div class="box-right">
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
 	<center><input type="submit" class="submit-order" value="Order Now!" name="order" />	</center>
</div>
<form action="" method="post">
	
</form>	
<?php
	include 'inc/footer.php';
?>
