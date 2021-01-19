<?php namespace App\Controllers;
use Bcrypt\Bcrypt;


class Admin extends BaseController
{
	public function __construct()
	{
		helper('form');

	}
	public function index()
	{

		$userModel = new \App\Models\Mdl_admin();
		$tokoModel = new \App\Models\Mdl_data_toko();
		$jumlah_user = $userModel->countAll();
		$form_validation = \Config\Services::validation();
		$bcrypt = new Bcrypt();
		$bcrypt_version = '2a';
		
		// $coba = $user->findAll();
		// dd($coba);
		// $data = [
		// 	'username' => 'darth',
		// 	'password'    => 'd.vader@theempire.com',
		// 	'level' => 1
		// ];

		// $userModel->insert($data);

		// $bcrypt = new Bcrypt();
		// $plaintext = 'password';

		//Set the Bcrypt Version, default is '2y'
		// $bcrypt_version = '2a';

		// $ciphertext = $bcrypt->encrypt($plaintext,$bcrypt_version);
		// print_r("\n Plaintext:".$plaintext);
		// print_r("\n Ciphertext:".$ciphertext);

		//Verify the plaintext and ciphertext
		// if($bcrypt->verify($plaintext, $ciphertext)){
		// 	print_r("\n Password verified!");
		// }else{
		// 	print_r("\n Password not match!");
		// }




		if ($jumlah_user == 0) {
			if ($this->request->getPost("submit") == "submit") {
				$form_validation->setRules([
					'nama_depan' => 'required',
					'nama_belakang' => 'required',
					'username' => 'required',
					'password' => 'required|min_length[4]|max_length[39]'
				]);
	
				if($form_validation->withRequest($this->request)->run() && $jumlah_user == 0){
					$userdata = [
						"nama_depan" => $_POST["nama_depan"],
						"nama_belakang" =>  $_POST["nama_belakang"],
						"username" =>  $_POST["username"],
						"password" =>  $bcrypt->encrypt($_POST["password"],$bcrypt_version),
						"level" => 1
					];
					$datatoko = [
						"nama" =>  $_POST["nama_toko"],
						"alamat" =>  $_POST["alamat_toko"],
					];
					$userModel->insert($userdata);
					$tokoModel->insert($datatoko);
					$session = session();
					$session->setFlashData("success", "Successful Registration");
					// return redirect()->to($_SERVER['REQUEST_URI'], 'refresh');
					return redirect()->to(site_url().'index.php/admin');
				}
			}
			return view('admin/reg.php');
		} else {
			$data['title'] = 'Login';
			if ($this->request->getPost("submit") == "submit") {
				$form_validation->setRules([
					'username' => 'required|max_length[39]',
					'password' => 'required|min_length[4]|max_length[39]'
				]);
				if($form_validation->withRequest($this->request)->run()){
					return redirect()->to('111');
				}
			}
			return view('admin/login.php', $data);
		
		}
		//login


	}
	function login(){

	}
	function register(){

	}
	function _make_sure_is_admin(){

	}
	function _level_admin(){

	}
	function check_password(){
		$pass1 = $_POST['password'];
		$pass2 = $_POST['confirm_password'];
		if (strlen($pass1)>=40){
			$hasil = 'terlalu panjang';
		}else{
			if ($pass1 == $pass2 && strlen($pass1)>=5) {
				$hasil = 'sesuai';
			}else{
				$hasil = false;
			}
		}

		if($hasil == 'sesuai'){
			echo '<label class="text-success"><span><i class="fa fa-check-circle-o" aria-hidden="true"></i> Password Sesuai</span></label>';
		}
		else if($hasil == 'terlalu panjang'){
			echo '<label class="text-danger"><span><i class="fa fa-times" aria-hidden="true">
			</i>Password terlalu panjang</span></label>';
		}
		else {
			echo '<label class="text-danger"><span><i class="fa fa-times" aria-hidden="true">
			</i>Password tidak sama atau kurang dari 5 karakter</span></label>';
		}
	}

	//--------------------------------------------------------------------

}
