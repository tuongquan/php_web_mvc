
<?php
	include_once'inc/header.php';
	include_once 'inc/slider.php';
?>


 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
					$product_feathered = $product->getproduct_feathered();
	      		if($product_feathered){
	      		 	while($result_product = $product_feathered->fetch_assoc()){

	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/uploads/<?php echo $result_product['image']?>" alt="" /></a>
					 <h2><?php echo $result_product['productName']?></h2>
					 <p><?php echo $fm->textShorten($result_product['product_desc'], 20)?></p>

					 <p><span class="price"><?php echo $result_product['price']?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_product['productId']?>" class="details">Details</a></span></div>
				</div>
				<?php
					}
	      	}
				?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
					$product_new = $product->getproduct_new();
	      		if($product_new){
	      		 	while($result_new = $product_new->fetch_assoc()){

	      		
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.html"><img src="admin/uploads/<?php echo $result_new['image']?>" alt="" /></a>
					 <h2><?php echo $result_new['productName']?> </h2>
					 <p><?php echo $fm->textShorten($result_new['product_desc'], 20)?></p>
					 <p><span class="price"><?php echo $result_new['price']?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId']?>" class="details">Details</a></span></div>
				</div>
				<?php
					}
	      	}
				?>
			</div>
    </div>
 </div>
</div>

<?php
	include 'inc/footer.php';
?>
   