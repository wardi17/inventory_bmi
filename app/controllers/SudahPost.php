<?php

class SudahPost extends Controller {

		public function index()
		{
			$data['pages'] = "inv_sidebar";
			$data['page'] = "post";
			$this->view('templates/header');
			$this->view('templates/sidebar',$data);
			$this->view('sudahposting/index', $data);
			$this->view('templates/footer');
		}


		
		public function sudahposting(){
			
			$data= $this->model('MutasiModel')->TampilListSudahposting($_POST);
					
			if(empty($data)){
				$data = null;
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}




		public function ViewPosting(){
			
			$userid =(isset( $_POST["userid"]))?  $_POST["userid"] : '';

			if($userid !==""){
			   $data = $this->model('MutasiModel')->ViewSudahposting($_POST);
			   $this->view('sudahposting/print',$data);
			}else{
			   $this->view('templates/header');
			   $this->view('templates/alertlog');
		   
			}
		
			
		}



	
}