<?php

class Inventori extends Controller {


		public function index()
		{
			$data['pages'] = "inv_sidebar";
			$data['page'] = "inv";
			$this->view('templates/header');
			$this->view('templates/sidebar',$data);
			$this->view('inventori/index', $data);
			$this->view('templates/footer');
		}


		public function tambah()
		{
			$data['pages'] = "inv_sidebar";
			$data['page'] = "inv";
			$data['transtype'] = $this->model('TransTypeModel')->TampilDataType();
			$data['wherhouse'] = $this->model('TransTypeModel')->TampilDataWarehouse();
			$this->view('templates/header');
			$this->view('templates/sidebar',$data);
			$this->view('inventori/tambah', $data);
			$this->view('templates/footer');
		}

		

		public function edit(){
			$data['pages'] = "inv_sidebar";
			$data['page'] = "inv";
			$data['SoTransacID'] = (isset( $_POST["SoTransacID"]))?  $_POST["SoTransacID"] : '';
			$data['userid'] = (isset( $_POST["userid"]))?  $_POST["userid"] : '';
			$data['transtype'] = $this->model('TransTypeModel')->TampilDataType();
			$data['wherhouse'] = $this->model('TransTypeModel')->TampilDataWarehouse();
			$this->view('templates/header');
			$this->view('templates/sidebar',$data);
			$this->view('inventori/edit', $data);
			$this->view('templates/footer');
		}



		public function Tampilposing(){
			$data['pages'] = "inv_sidebar";
			$data['page'] = "inv";
			$data['SoTransacID'] = (isset( $_POST["SoTransacID"]))?  $_POST["SoTransacID"] : '';
			$data['userid'] = (isset( $_POST["userid"]))?  $_POST["userid"] : '';
			$data['transtype'] = $this->model('TransTypeModel')->TampilDataType();
			$data['wherhouse'] = $this->model('TransTypeModel')->TampilDataWarehouse();
			$this->view('templates/header');
			$this->view('templates/sidebar',$data);
			$this->view('inventori/posting', $data);
			$this->view('templates/footer');
		}




		public function ViewPosting(){
			$userid =(isset( $_POST["userid"]))?  $_POST["userid"] : '';

			 if($userid !==""){
				$data = $this->model('MutasiModel')->ViewSudahposting($_POST);
				$this->view('inventori/print',$data);
			 }else{
				$this->view('templates/header');
				$this->view('templates/alertlog');
			
					
			 }
		

			
			
		}

	
}