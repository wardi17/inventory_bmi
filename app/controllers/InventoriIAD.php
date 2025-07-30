<?php

class InventoriIAD extends Controller{




    public function getListtype(){
        $data= $this->model('TransTypeModel')->TampilDataType();
					
        if(empty($data)){
            $data = null;
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
    }


    public function getwarehouse(){
      
        $data= $this->model('TransTypeModel')->TampilDataWarehouse();
					
        if(empty($data)){
            $data = null;
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
    }


    
    public function getpartid(){
      
       
        $data= $this->model('TransTypeModel')->TampilDatapartid($_POST);
					
        if(empty($data)){
            $data = null;
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
    }



    public function Simpandata(){
        $data= $this->model('MutasiModel')->SaveDatatempt($_POST);
					
        if(empty($data)){
            $data = null;
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
    }



    public function Tampildata(){
       
        $data= $this->model('MutasiModel')->TampildataMutasiTemp($_POST);
					
        if(empty($data)){
            $data = null;
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
    }


    
    public function DeletdataRow(){
        $data= $this->model('MutasiModel')->DeleteDatatemptRow($_POST);
					
        if(empty($data)){
            $data = null;
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
    }




    public function DeletdataALL(){
        $data= $this->model('MutasiModel')->DeleteDatatemptAll($_POST);
					
        if(empty($data)){
            $data = null;
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
    }


    public function postingsave(){
        $data= $this->model('MutasiModel')->PostingMutasiData($_POST);
					
        if(empty($data)){
            $data = null;
            echo json_encode($data);
        }else{
            echo json_encode($data);
        } 
    }





    public function listdata(){
        $data= $this->model('MutasiModel')->TampilListdata($_POST);
					
        if(empty($data)){
            $data = null;
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
    }

    
    
    public function Updatedata(){
        $data= $this->model('MutasiModel')->UpdateDatatempt($_POST);
					
        if(empty($data)){
            $data = null;
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
    }
}