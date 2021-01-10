<?php namespace App\Controllers;
use Bcrypt\Bcrypt;


class Admin extends BaseController
{
	public function index()
	{
		$userModel = new \App\Models\Mdl_admin();
		$jumlah_user = $userModel->countAll();
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
            return view('admin/reg.php');
        } else {
            return view('admin/login.php');
        }

	}
	function login(){

	}
	function register(){
		
	}
	function _make_sure_is_admin(){

	}
	function _level_admin(){
		
	}

	//--------------------------------------------------------------------

}
