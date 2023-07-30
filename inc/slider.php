
	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getLastestApsara = $product->getLastestApsara();
					if($getLastestApsara){
						while($resultApsara = $getLastestApsara->fetch_assoc() ){
								
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php"> <img src="admin/uploads/<?php echo $resultApsara['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Apsara</h2>
						<p><?php echo $resultApsara['productName']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultApsara['productId']?>">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php
			   		}
			   	}
			   	?>
			   	<?php
					$getLastestHatesla = $product->getLastestHatesla();
					if($getLastestHatesla){
						while($resultHatesla = $getLastestHatesla->fetch_assoc() ){
								
				?>		
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview.php"><img src="admin/uploads/<?php echo $resultHatesla['image']?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>HATESLA</h2>
						  <p><?php echo $resultHatesla['productName']?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultHatesla['productId']?>">Add to cart</a></span></div>
					</div>
				</div>
			</div>
			 <?php
			   		}
			   	}
			   	?>
	   		<?php
			$getLastestHaDao = $product->getLastestHaDao();
			if($getLastestHaDao){
				while($resultHaDao = $getLastestHaDao->fetch_assoc() ){
						
				?>	
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php"> <img src="admin/uploads/<?php echo $resultHaDao['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Hà Đào</h2>
						<p><?php echo $resultHaDao['productName']?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultHaDao['productId']?>">Add to cart</a></span></div>
				   </div>
			   </div>
			    <?php
			   		}
			   	}
			   	?>		
				<?php
					$getLastestEnVang = $product->getLastestEnVang();
					if($getLastestEnVang){
						while($resultEnVang = $getLastestEnVang->fetch_assoc() ){
								
				?>	
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview.php"><img src="admin/uploads/<?php echo $resultEnVang['image']?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Én Vàng</h2>
						  <p><?php echo $resultEnVang['productName']?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultEnVang['productId']?>">Add to cart</a></span></div>
					</div>
				</div>
				 <?php
			   		}
			   	}
			   	?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	