<?php namespace App\Controllers;
use Bcrypt\Bcrypt;


class Admin extends BaseController
{
	protected $bcrypt;
	protected $bcrypt_version;
	protected $session;
	public function __construct()
	{
		$this->session = session();
		$this->bcrypt = new Bcrypt();
		$this->bcrypt_version = '2a';
		helper('form');

	}
	public function index(){
		$userModel = new \App\Models\Mdl_admin();
		$tokoModel = new \App\Models\Mdl_data_toko();
		$jumlah_user = $userModel->countAll();
		$form_validation = \Config\Services::validation();
		if ($this->_make_sure_is_login()) {
			//login == true
			$this->_make_sure_is_admin();
			$data['title'] = "Dashboard";
			//kode dalam Dashboard


			//end kode Dashboard
			echo view('admin/index.php', $data);
			//end login == true
		}else{
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
							"password" =>  $this->bcrypt->encrypt($_POST["password"],$this->bcrypt_version),
							"level" => 1
						];
						$datatoko = [
							"nama" =>  $_POST["nama_toko"],
							"alamat" =>  $_POST["alamat_toko"],
						];
						$userModel->insert($userdata);
						$tokoModel->insert($datatoko);
						$this->session->setFlashData("success", "Successful Registration");
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
						$this->login($_POST["username"],$_POST["password"]);
						return redirect()->to(site_url().'index.php/admin');
					}
				}
				return view('admin/login.php', $data);
			}
			//login
		} //tutup admin login = false
	}
	public function barang(){
		if ($this->_make_sure_is_login()) {
			$data['title'] = "Data Barang";
			return view('admin/barang.php', $data);
		}else {
			$this->session->destroy();
			return redirect()->to(site_url().'index.php/admin');
		}
	}
	public function login($username,$password){
		$userModel = new \App\Models\Mdl_admin();
		$admin_data = $userModel->get_cipherpass($username);
		if ($admin_data != NULL) {
			if($this->bcrypt->verify($password, $admin_data['password'])){
				$data_login = [
					'nama' => $admin_data['nama_depan'].' '.$admin_data['nama_belakang'],
					'user' => $admin_data['username'],
					'level' => $admin_data['level'],
					'status'=> TRUE
				];
				$this->session->set('login_data', $data_login);
			}else{
				$this->session->setFlashData("gagal", "Login Failed!");
			}
		}else {
			$this->session->setFlashData("gagal", "Login Failed!");
		}
	}
	function register(){

	}
	function _make_sure_is_login(){
		if (isset($_SESSION['login_data'])) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
	function _make_sure_is_admin(){
		if ($this->_make_sure_is_login() != TRUE) {
			$this->session->destroy();
			return redirect()->to(site_url().'index.php/admin');
		}
	}
	function logout(){
		$this->session->destroy();
		return redirect()->to(site_url().'index.php/admin');
	}
	public function check_password(){
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
