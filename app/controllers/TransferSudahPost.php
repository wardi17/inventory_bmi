<?php

class TransferSudahPost extends Controller {

		public function index()
		{
			$data['pages'] = "tf_sidebar";
			$data['page'] = "tf_post";
			$this->view('templates/header');
			$this->view('templates/sidebar',$data);
			$this->view('transfersudahpost/index', $data);
			$this->view('templates/footer');
		}


		
		public function sudahposting(){
			
			$data= $this->model('MutasiTransferModel')->TampilListSudahposting($_POST);
					
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
			   $this->view('transfersudahpost/print',$data);
			}else{
			   $this->view('templates/header');
			   $this->view('templates/alertlog');
		   
			}
		
			
		}



	
}