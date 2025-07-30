<?php

class Home extends Controller {

	public function index()
	{
		$data['page'] = "invent";
		$data['title'] = 'Halaman Home';

		$userlog =(isset($_SESSION['login_user']))? $_SESSION['login_user'] : ''; 
	

		if($userlog =='') {
			$this->view('templates/header');
			$this->view('templates/alertlog');
		}else{
			$data['pages'] = "home";
			$this->view('templates/header', $data);
			$this->view('templates/sidebar', $data);
			$this->view('home/index', $data);
			$this->view('templates/footer');
		}
	
	}
}