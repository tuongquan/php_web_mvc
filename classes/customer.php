<?php
	$file_name = realpath(dirname(__FILE__));
	include_once ($file_name.'/../lib/database.php');
	include_once ($file_name.'/../helpers/format.php');
	
?>


<?php
/**
 * 
 */
class customer 
{
	private $db;
	private $fm;// format
	
	public function __construct()
	{
		$this->db = new Database();//truyen class Database từ databases.php sang biến db
		$this->fm = new Format();
	}
	public function insert_customers($data){
		$name = mysqli_real_escape_string($this->db->link, $data['name']);//link là biến kết nối từ file databases.php
		$country = mysqli_real_escape_string($this->db->link, $data['country']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
		$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$city = mysqli_real_escape_string($this->db->link, $data['city']);
		if($name =="" || $country == "" || $email == "" || $phone == "" || $zipcode == "" || $password == "" || $address == "" || $city == ""){
			$alert = "<span class='error'>Fields must be no empty </span>";
			return $alert;
		}else {
			$check_email = " SELECT * FROM  tbl_customer WHERE email='$email' LIMIT 1";
			$result_check = $this ->db->select($check_email);
			if($result_check){
				$alert = "<span class='error'>Email Already Existed! PLEASE ENTER ANOTHER EMAIL </span>";
			return $alert;
			}else {
				$query = "INSERT INTO tbl_customer(name, city, country, email, phone, zipcode, password, address) VALUES ('$name', '$city', '$country', '$email', '$phone', '$zipcode', '$password', '$address')";
				$result = $this -> db->insert($query);
				if($result){
					$alert = "<span class='success'>SUCCESSFULLY</span>";
					return $alert;
				}else{
					$alert = "<span class='success'>NOT SUCCESSFULLY</span>";
					return $alert;
				}
			}
		}
		
	}
	public function login_customers($data){
		$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		if( $password == "" || $email == ""){
			$alert = "<span class='error'>Fields must be no empty </span>";
			return $alert;
		}else {
			$check_login = " SELECT * FROM  tbl_customer WHERE email='$email' AND password = '$password' LIMIT 1";
			$result_check = $this ->db->select($check_login);
			if($result_check != false){
				$value = $result_check -> fetch_assoc();
				Session::set('customer_login',true);
				Session::set('customer_id', $value['id']);
				Session::set('customer_name', $value['name']);
				header('Location:order.php');
			}else {
				$alert = "<span class='error'>Email AND password Doesn't Match </span>";
				return $alert;
				}
			}
		}
	public function show_customers($id){
	$query = "SELECT * FROM tbl_customer WHERE id = '$id'";

	$result = $this ->db->select($query);
	return $result;

	}
	public function update_customers($data, $id){
		$name = mysqli_real_escape_string($this->db->link, $data['name']);//link là biến kết nối từ file databases.php
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		
		if($name ==""  || $email == "" || $phone == "" || $zipcode == "" ||$address == "" ){
			$alert = "<span class='error'>Fields must be no empty </span>";
			return $alert;
		}else {
					 
				$query = "UPDATE  tbl_customer SET name ='$name', email='$email', phone='$phone', zipcode='$zipcode', address='$address' WHERE id = '$id'";
				$result = $this -> db->update($query);
				if($result){
					$alert = "<span class='success'>SUCCESSFULLY</span>";
					return $alert;
				}else{
					$alert = "<span class='success'>NOT SUCCESSFULLY</span>";
					return $alert;
				}
			
		}
	}
}

?>