<?php
	$file_name = realpath(dirname(__FILE__));
	include_once ($file_name.'/../lib/database.php');
	include_once ($file_name.'/../helpers/format.php');
	
?>


<?php
/**
 * 
 */
class product 
{
	private $db;
	private $fm;// format
	
	public function __construct()
	{
		$this->db = new Database();//truyen class Database từ databases.php sang biến db
		$this->fm = new Format();
	}
	public function insert_product($data,$files)
	{
		
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);//link là biến kết nối từ file databases.php
		$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		$category = mysqli_real_escape_string($this->db->link, $data['category']);
		$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		//$image = mysqli_real_escape_string($this->db->link, $data['productName']);
		//kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;
		if($productName==""|| $brand =="" || $category==""|| $product_desc=="" || $type =="" || $price == "" || $file_name=""){
			$alert = "<span class='error'>Fields Must be not empty </span>";
			return $alert;
		}else 
		{
			move_uploaded_file($file_temp,$uploaded_image);
			$query = "INSERT INTO tbl_product(productName,brandId,catId,product_desc,type,price,image) VALUES('$productName','$brand','$category','$product_desc','$type','$price','$unique_image')";
			$result = $this->db->insert($query); 
			if($result){
				$alert = "<span class='success'>Insert Product Successfully</span>";
				return $alert;
				echo "<script>window.location= 'productlist.php' </script>";
			}else {
				$alert = "<span class='error'>Insert Product Not Successfully</span>";
				return $alert;
			}
		}
	}
	public function show_product(){
		$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId order by tbl_product.productId desc";

		$result = $this ->db->select($query);
		return $result;
	
	}

	
	public function getproductbyId($id) {
		$query = "SELECT * FROM tbl_product where productId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_product($data, $file, $id){
	    $productName = mysqli_real_escape_string($this->db->link, $data['productName']);//link là biến kết nối từ file databases.php
		$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
		$category = mysqli_real_escape_string($this->db->link, $data['category']);
		$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link,$data['type']);
		
		//kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;//random từ 0 tới 10 và nối đuôi với file ext
		$uploaded_image = "uploads/".$unique_image;

		if($productName==""|| $brand =="" || $category==""|| $product_desc=="" || $type="" || $price == "" ||  $file_name=""){
			$alert = "<span class='error'>Fields Must be not empty </span>";
			return $alert;
		}else {
			if(!empty($file_name)){
				//Nếu người dùng chọn ảnh
				if($file_size > 1048567){//1048567 10mb
					$alert ="<span class='error'>Image size should be less then 10MB</span>";
					return $alert;
				}else if(in_array($file_ext, $permited) === false){
					$alert ="<span class='success'>You can upload only:-".implode(',', $permited)."</span>";
					return $alert;
				}
				$query = "UPDATE tbl_product SET
				 productName = '$productName',
				 brandId = '$brand',
				 catId = '$category',
				 type='$type',
				price = '$price',
				image = '$unique_image',
				product_desc = '$product_desc'
				WHERE productId = '$id'";

			}else {
				if($file_size > 1048567){//1048567 10mb
					$alert ="<span class='error'>Image size should be less then 1MB</span>";
					return $alert;
				}else if(in_array($file_ext, $permited) === false){
					$alert ="<span class='success'>You can upload only:-".implode(',', $permited)."</span>";
					return $alert;
				}
				//Nếu người dùng không chọn ảnh
				$query = "UPDATE tbl_product SET
				productName = '$productName',
				brandId = '$brand',
				catId = '$category',
				price = '$price',
				type = '$type',
				product_desc = '$product_desc'
				WHERE productId = '$id'";

			}
			$result = $this->db->update($query); 
			if($result){
				$alert = "<span class='success'> Product Updated Successfully</span>";
				return $alert;
			}else {
				$alert = "<span class='error'> Product  Updated Not Successfully</span>";
				return $alert;
			}
		}
	}
	public function del_product($id){
		$query = "DELETE FROM tbl_product where productId ='$id'";
		$result = $this->db->delete($query);
		if($result){
			$alert = "<span class='success'> Product Deleted Successfully</span>";
			return $alert;
		}else {
			$alert = "<span class='error'> Product  Deleted Not Successfully</span>";
			return $alert;
		}
	}
	//END BACKEND

	public function getproduct_feathered(){
		$query = "SELECT * FROM tbl_product where type = '0'";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function getproduct_new(){
		$query = "SELECT * FROM tbl_product order by productId desc LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}

	public function get_details($id){
		$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'";

		$result = $this ->db->select($query);
		return $result;
	}
	public function getLastestApsara(){
		$query = "SELECT * FROM tbl_product WHERE brandId ='1' ORDER BY productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function getLastestHaDao(){
		$query = "SELECT * FROM tbl_product WHERE brandId ='6' ORDER BY productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function getLastestHatesla(){
		$query = "SELECT * FROM tbl_product WHERE brandId ='3' ORDER BY productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function getLastestEnVang(){
		$query = "SELECT * FROM tbl_product WHERE brandId ='4' ORDER BY productId desc LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
}
