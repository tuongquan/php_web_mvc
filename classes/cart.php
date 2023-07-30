<?php
	
	$file_name = realpath(dirname(__FILE__));
	include_once ($file_name.'/../lib/database.php');
	include_once ($file_name.'/../helpers/format.php');
	
?>


<?php


 class cart 
{
	private $db;
	private $fm;// format
	
	public function __construct()
	{
		$this->db = new Database();//truyen class Database từ databases.php sang biến db
		$this->fm = new Format();
	}
	public function add_to_cart($quantity,$id){

		$quantity = $this->fm->validation($quantity);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);//link là biến kết nối từ file databases.php
		$id = mysqli_real_escape_string($this->db->link, $id);//id của session id
		$sId = session_id();

		$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$result = $this->db->select($query)->fetch_assoc();//truy van vao co so du lieu va lay du lieu ra
		$image = $result["image"];
		$productName = $result["productName"];
		$price = $result["price"];
		// echo '<pre>';
		// echo print_r($result);
		// echo '</pre>';
		//$check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id'";
		
		// if($result){
		// 	$msg = "PRODUCT ALREADY ADDED";
		// 	return $msg;
		// }
		//else{
			$query_insert = "INSERT INTO tbl_cart(productId,quantity,sId,productName,image,price) VALUES('$id','$quantity','$sId','$productName','$image','$price')";
			$insert_cart = $this->db->insert($query_insert); 
			if($insert_cart){
				header('Location:cart.php');
				
			}else {
				header('Location:404.php');
			}
		//}
	}
	public function get_product_cart() {
		$sId = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_quantity_cart($quantity, $cartId){
		// $quantity = $this->fm->validation($quantity);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);//link là biến kết nối từ file databases.php
		$cartId = mysqli_real_escape_string($this->db->link, $cartId);
		$query_update_quantity = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
		$result = $this->db->update($query_update_quantity); 
		if($result){
			$notice = "<span class='success'>UPDATE QUANTITY SUCCESS</span>";
			return $notice;
		}else{
			$notice = "<span class='error'>UPDATE NOT QUANTITY SUCCESS</span>";
			return $notice;
		}
	}
	public function del_product_cart($cartid){
		$cartid = mysqli_real_escape_string($this->db->link, $cartid);
		$query = "DELETE FROM tbl_cart WHERE cartId = '$cartid'";
		$result = $this->db->delete($query);
		if($result){
			header('Location:cart.php');
			
		}else{
			$notice = "<span class='error'>DELETE NOT QUANTITY SUCCESS</span>";
			return $notice;
		}
	}
	//
	public function check_cart(){
		$sId = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}
	public function del_all_data_cart(){
		$sId = session_id();
		$query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
		$result = $this->db->delete($query);
		return $result;
	}
}
?>
