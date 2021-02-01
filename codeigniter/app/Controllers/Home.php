<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$userModel = new \App\Models\Mdl_admin();
		// $coba = $user->findAll();
		// dd($coba);
		// $data = [
		// 	'username' => 'darth',
		// 	'password'    => 'd.vader@theempire.com',
		// 	'level' => 1
		// ];
		
		// $userModel->insert($data);
		return view('home/index.php');
	}

	//--------------------------------------------------------------------

}
