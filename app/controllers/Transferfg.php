<?php

class Transferfg extends Controller {


		public function index()
		{
			
			$data['pages'] = "tf_sidebar";
			$data['page'] = "tf";
			$this->view('templates/header');
			$this->view('templates/sidebar',$data);
			$this->view('transerferfg/index', $data);
			$this->view('templates/footer');
		}


		public function tambah()
		{
		
			
			$data['pages'] = "tf_sidebar";
			$data['page'] = "tf";
			
			$data['wherhouse'] = $this->model('TransTypeModel')->TampilDataWarehouse();
			$this->view('templates/header');
			$this->view('templates/sidebar',$data);
			$this->view('transerferfg/tambah', $data);
			$this->view('templates/footer');
		}

		

		public function edit(){
			$data['pages'] = "tf_sidebar";
			$data['page'] = "tf";
			$data['SoTransacID'] = (isset( $_POST["SoTransacID"]))?  $_POST["SoTransacID"] : '';
			$data['userid'] = (isset( $_POST["userid"]))?  $_POST["userid"] : '';
			$data['transtype'] = $this->model('TransTypeModel')->TampilDataType();
			$data['wherhouse'] = $this->model('TransTypeModel')->TampilDataWarehouse();
			$this->view('templates/header');
			$this->view('templates/sidebar',$data);
			$this->view('transerferfg/edit', $data);
			$this->view('templates/footer');
		}



		public function Tampilposing(){
			$data['pages'] = "tf_sidebar";
			$data['page'] = "tf";
			$data['SoTransacID'] = (isset( $_POST["SoTransacID"]))?  $_POST["SoTransacID"] : '';
			$data['userid'] = (isset( $_POST["userid"]))?  $_POST["userid"] : '';
			//$data['transtype'] = $this->model('TransTypeModel')->TampilDataType();
			$data['wherhouse'] = $this->model('TransTypeModel')->TampilDataWarehouse();
			$this->view('templates/header');
			$this->view('templates/sidebar',$data);
			$this->view('transerferfg/posting', $data);
			$this->view('templates/footer');
		}




		public function ViewPosting(){
		
			$userid =(isset( $_POST["userid"]))?  $_POST["userid"] : '';

			 if($userid !==""){
				$data = $this->model('MutasiModel')->ViewSudahposting($_POST);
				//die(var_dump($data));
				$this->view('transerferfg/print',$data);
			 }else{
				$this->view('templates/header');
				$this->view('templates/alertlog');
			
					
			 }
		

			
			
		}

	
}