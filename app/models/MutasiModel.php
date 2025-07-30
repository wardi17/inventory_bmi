<?php

date_default_timezone_set('Asia/Jakarta');
class MutasiModel{
    private $tablehead= 'mutasi2';
    private $tabledetail= 'mutasidetail2';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}


	protected function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}

    public function SaveDatatempt($data)
	{
        
            $head = $data["datahead"];
            
			$userid =$this->test_input($head["userid"]);
			$shipdate =$this->test_input($head["tanggal"]);
			$transnohider =$this->test_input($head["transnohider"]);
			$soentrydesc =$this->test_input($head["keterangan"]);
            $useridenty = $this->test_input($head["userid"]);
            $dateentry =   date("Y-m-d H:i:s");
            $cekhead =  $this->CekTempHeadr($transnohider);
            $flagtf ='NULL';
            if($cekhead == 0){
                 $query ="SP_INSERT_MUTASI '".$transnohider."','".$shipdate."','".$soentrydesc."','".$dateentry."','".$useridenty."','".$userid."','".$flagtf."' ";
             
                // $query ="INSERT  INTO $this->tablehead (SoTransacID,Shipdate,SOEntryDesc,DateEntry,UserIDEntry,DateValidasi,UserId)
                // VALUES('".$transnohider."','".$shipdate."','".$soentrydesc."','".$dateentry."','".$useridenty."','".$userid."')";
                $this->db->baca_sql2($query);
            }

         
            $detail = $data["datadetail"];
            $transno =$this->test_input($detail["transno"]);
            $transtype =$this->test_input($detail["transtype"]);
            $refno =$this->test_input($detail["refno"]);
            $warehouse =$this->test_input($detail["warehouse"]);
            $partid =$this->test_input($detail["partid"]);
            $pcs =$this->test_input($detail["pcs"]);
            $comment =$this->test_input($detail["comment"]);
            $batchno =$this->test_input($detail["batchno"]);
       

            $query2 =" SP_INSERT_MUTASIDETAIL '".$transno."','".$partid."','".$transtype."','".$refno."','".$batchno."','".$pcs."',
            '".$comment."','".$warehouse."'";

            // $query2 ="INSERT  INTO $this->tabledetail (SoTransacID,PartId,PartName,transtype,refno,batchno,pcs,keterangan,warehouse,prodclass,product,subprod)
            // VALUES('".$transno."','".$partid."','".$partname."','".$transtype."','".$refno."','".$batchno."','".$pcs."','".$comment."','".$warehouse."','".$prodclass."','".$product."','".$subprod."')";
           
           $this->db->baca_sql2($query2);
		
           return   $this->getdataDetail($transno);
	}




    //cek sotransasi
	private function CekTempHeadr($transnohider){
	

		$query = "SELECT DISTINCT  SOTransacID FROM $this->tablehead where SOTransacID ='".$transnohider."' ";
		$result= $this->db->baca_sql2($query);
		$rows= odbc_fetch_array($result); 
		$valid=0;
		if($rows > 0){
			$valid=1;
		}

		return $valid;
	}
//end sotransaksi


        public function TampildataMutasiTemp($data){
            
            $userid =$this->test_input($data["userid"]);
            $SoTransacID =$this->test_input($data["SoTransacID"]);
            $query ="SP_TampilDataMutasi '".$SoTransacID."'";
		
   
            $result2 = $this->db->baca_sql2($query);
            $dataheader =[];
          
            while(odbc_fetch_row($result2)){
               
                $dataheader[] =[
                    "Shipdate" => date('Y-m-d',strtotime(rtrim(odbc_result($result2,'Shipdate')))),
                    "SOEntryDesc" => rtrim(odbc_result($result2,'SOEntryDesc')),
                ];
                }
                
          $datadetail = $this->getdataDetail($SoTransacID);

          $datafull  =[
			'datahider'=>$dataheader,
			'datadetail'=>$datadetail
		];
	
	   //die(var_dump($datafull));
		return $datafull;
        }



  

        public function getdataDetail($SoTransacID){
            $query ="SP_TampilDataMutasiDetail '".$SoTransacID."'";
            $result2 = $this->db->baca_sql2($query);
            $datas =[];

            while(odbc_fetch_row($result2)){
               
                $datas[] =[
                    "Itemno" =>((int)rtrim(odbc_result($result2,'Itemno'))),
                    "PartId" => rtrim(odbc_result($result2,'PartId')),
                    "PartName" => rtrim(odbc_result($result2,'PartName')),
                    "subprod" => rtrim(odbc_result($result2,'subprod')),
                    "prodclass" => rtrim(odbc_result($result2,'prodclass')),
                    "product" => rtrim(odbc_result($result2,'product')),
                    "Quantity" =>(int)rtrim(odbc_result($result2,'Quantity')),
                    "Refno" => rtrim(odbc_result($result2,'Refno')),
                    "batchno" => rtrim(odbc_result($result2,'batchno')),
                    "warehouse" => rtrim(odbc_result($result2,'warehouse')),
                    "transtype" => rtrim(odbc_result($result2,'transtype')),
                    "keterangan" =>rtrim(odbc_result($result2,'keterangan')),
                ];
                }


               /* echo "<pre>";
                print_r($datas);
                echo "</pre>";
                die();*/
               return $datas;
        }






 public function DeleteDatatemptRow($data){
    $transno =$this->test_input($data["transno"]);
    $itemno =$this->test_input($data["itemno"]);

    $query ="DELETE  FROM  $this->tabledetail WHERE SoTransacID='".$transno."' AND Itemno='".$itemno."' ";
    $this->db->baca_sql2($query);

    return   $this->getdataDetail($transno);
 }


 public function DeleteDatatemptAll($data){

    $transno =$this->test_input($data["transno"]);
    $userid =$this->test_input($data["userid"]);
    $query ="DELETE FROM  $this->tablehead WHERE SoTransacID='".$transno."' AND UserId='".$userid."'
             DELETE FROM $this->tabledetail WHERE SoTransacID='".$transno."'";
 
    $this->db->baca_sql2($query);

    return   $this->getdataDetail($transno);
 }








    public function PostingMutasiData($data){
        $tglposting = date("Y-m-d H:i:s");
        $transno =$this->test_input($data["transno"]);
        $userid =$this->test_input($data["userid"]);
     
        $query = "SP_VALIDASI_MUTASI '".$transno."','".$userid."' ";
       
      
        $result2 = $this->db->baca_sql3($query);
            $datas =[];

            while(odbc_fetch_row($result2)){
               
                $datas[] =[
                    "PartId" => rtrim(odbc_result($result2,'PartId')),
                    "transtype" => rtrim(odbc_result($result2,'transtype')),
                    "PartName" => rtrim(odbc_result($result2,'PartName')),
                    "flagstock" => rtrim(odbc_result($result2,'flagstock')),
                    "Quantity" =>(int)rtrim(odbc_result($result2,'Quantity')),
                    "Shipdate" =>  date('d/m/Y',strtotime(rtrim(odbc_result($result2,'Shipdate')))),
                    "warehouse" => rtrim(odbc_result($result2,'warehouse')),
                    "stock_max" => $this->GetStockMax(rtrim(odbc_result($result2,'warehouse')),rtrim(odbc_result($result2,'PartId')), date('m/d/Y',strtotime(rtrim(odbc_result($result2,'Shipdate')))))
                ];
                }


        $datahasil =[];
        foreach($datas as $items){
            $datahasil[] =[
                "transtype" => $items["transtype"],
                "PartId" => $items["PartId"],
                "PartName" => $items["PartName"],
                "Quantity" => $items["Quantity"],
                "warehouse" => $items["warehouse"],
                "stock_max" =>$this->SetSock($items["stock_max"]),
                "selisih" =>($items['flagstock']=="+" ? ((int)$items["stock_max"]+(int)$items["Quantity"]) :((int)$items["stock_max"]-(int)$items["Quantity"])),
                "Status_stok"=>$this->SetStatus($items["stock_max"],$items["Quantity"],$items['flagstock'],$items["warehouse"])
               
            ];
          

        }

            $status_array =[];
        foreach ($datahasil as $hasilitem){
            $status_array[] =
                $hasilitem['Status_stok'];
            
        }
        if (in_array("kurang", $status_array)) {
            
            $pesan['nilai']=2; //bernilai benar
            $pesan['error']=$datahasil;
            return $pesan;
          } else {
           

           return $this->SimpandDAta($transno,$userid,$tglposting);
          }

    }
 
    private function SimpandDAta($transno,$userid,$tglposting){
        
        $query2 ="SP_SIMPANDATA_MUTASI '".$transno."','".$userid."' ,'".$tglposting."' ";
        $result= $this->db->baca_sql2($query2);
        $flagsave=odbc_result($result,"flagsave");

       // die(var_dump($flagsave));
     
          if ($flagsave==NULL){
            $pesan['nilai']=1; //bernilai benar
            $pesan['error']="Tanggal Input  Sudahh Closeing";
            }else{
            $pesan['nilai']=0; //bernilai benar
            $pesan['error']="Berhasil  Posting";
            }

            return $pesan;
    }



    private function GetStockMax($warehouse,$partid,$shipdate){
        $query ="SP_GETmaxStock '".$warehouse."','".$partid."','".$shipdate."'";
        $sql =$this->db->baca_sql2($query);
		$totalpcs=odbc_result($sql,"totalpcs");
        return $totalpcs;

    }
 
    private function SetSock($stock){
            if($stock == false){
                return 0;
            }else{
                return (int)$stock;
            }
    }
    
	
	  private function SetStatus($stock_max,$qty,$flagstock,$warehouse){
        $status ="";

       
        $sub_st = substr($warehouse,0,2);
        if($sub_st =="T-"){
         $status  ="bisa";
        }else{
            if($flagstock =="+"){
            $status="bisa";
            }else{
                $a = (int)$stock_max;
                $b =(int)$qty;
        
                $jml = $a - $b;

                if($stock_max == false){
                    $status ="kurang";
                }else{
                    if($jml < 0){
                        $status ="kurang";
                        }else{
                            $status ="bisa";
                        }
                }
            }
        }
     
        return $status;
     }
	 
	 

     private function SetStatusxxx($stock_max,$qty,$flagstock){
        $status ="";
        if($flagstock =="+"){
        $status="bisa";
        }else{
            $a = (int)$stock_max;
            $b =(int)$qty;
    
            $jml = $a - $b;

            if($stock_max == false){
                $status ="kurang";
            }else{
                if($jml <= 0){
                    $status ="kurang";
                    }else{
                        $status ="bisa";
                    }
            }
        }
       
     
        return $status;
     }
     






    public function TampilListdata($data){
        $userlog = (isset( $_SESSION['login_user']))?  $_SESSION['login_user'] : '';
      
        if($userlog =='herman' OR $userlog =='lia' OR $userlog =='chiuyun' OR $userlog =='dinda' OR $userlog =='ryan'){
            $akseposting ='Y';
        }else{
            $akseposting ='N';
        }
        $userid =$this->test_input($data["userid"]);
        $tahun =$this->test_input($data["tahun"]);
   
        $query ="SP_TampilListDataMutasi '".$userid."','".$tahun."' , '".$akseposting."'";
       
   
        $result2 = $this->db->baca_sql2($query);
        $datas =[];

        while(odbc_fetch_row($result2)){
           
            $datas[] =[
                // "PartId" => rtrim(odbc_result($result2,'PartId')),
                // "PartName" => rtrim(odbc_result($result2,'PartName')),
                // "Quantity" =>(int)rtrim(odbc_result($result2,'Quantity')),
              
                // "warehouse" => rtrim(odbc_result($result2,'warehouse')),
                "SoTransacID" => rtrim(odbc_result($result2,'SoTransacID')),
                "Shipdate" =>date('d-m-y',strtotime(rtrim(odbc_result($result2,'Shipdate')))),
                "ket" =>rtrim(odbc_result($result2,'SOEntryDesc')),
                "UserId" =>rtrim(odbc_result($result2,'UserId')),
                "akseposting"=>$akseposting
            ];
            }

            // echo "<pre>";
            // print_r($datas);
            // echo "</pre>";
            // die();
        $fulldata =[];
          foreach ($datas as $item){
         
            $fulldata[] =[
                "SoTransacID" => $item['SoTransacID'],
                "Shipdate" => $item['Shipdate'],
                "UserId" => $item['UserId'],
                "ket" => $item['ket'],
                "akseposting" => $item['akseposting'],
                "gudang"=>$this->get_gudang($item['SoTransacID']),
                "TypePart"=>$this->TypePart($item['SoTransacID']),
                "detail" =>$this->get_Detelmutasi($item['SoTransacID']),
            ];
            
          }
            /*echo "<pre>";
            print_r($fulldata);
            echo "</pre>";
            die();*/
           return $fulldata;

       
    }

    private function get_gudang($SoTransacID){

        $query ="SELECT DISTINCT warehouse from $this->tabledetail WHERE SoTransacID='".$SoTransacID."' ";
     
        $result2 = $this->db->baca_sql2($query);
        $datas =[];
        while(odbc_fetch_row($result2)){
            $datas[]=rtrim(odbc_result($result2,'warehouse'));
        }
        $json_decode = json_encode($datas);

        $replacedata = $this->SetRiplace($json_decode);
      
        return $replacedata;
    }



    private function TypePart($SoTransacID){

        $query ="SELECT DISTINCT transtype from $this->tabledetail WHERE SoTransacID='".$SoTransacID."' ";
     
        $result2 = $this->db->baca_sql2($query);
        $datas =[];
        while(odbc_fetch_row($result2)){
            $datas[]=rtrim(odbc_result($result2,'transtype'));
        }
        $json_decode = json_encode($datas);

        $replacedata = $this->SetRiplace($json_decode);
      
        return $replacedata;
    }

    private function  SetRiplace($json_decode){
        
        $rep_st = str_replace('["','',$json_decode);
        $rep_st1 = str_replace('"]','',$rep_st);
        $rep_st2 = str_replace('","',',',$rep_st1);

     
        return $rep_st2;
    }

    private function get_Detelmutasi($SoTransacID){

        $query ="SP_TampilDatadetail '".$SoTransacID."'";
        $result2 = $this->db->baca_sql2($query);

        $datas =[];

        while(odbc_fetch_row($result2)){
           
            $datas=[
                "PartId" => rtrim(odbc_result($result2,'PartId')),
                "PartName" => rtrim(odbc_result($result2,'PartName')),
                "Quantity" =>(int)rtrim(odbc_result($result2,'Quantity')),
                "jumlah_rikode" =>(int)rtrim(odbc_result($result2,'jumlah_rikode')),
                 "warehouse" => rtrim(odbc_result($result2,'warehouse')),
            ];
        }

        return $datas;
    }




    public function TampilListSudahposting($data){
   
        $userlog = (isset( $_SESSION['login_user']))?  $_SESSION['login_user'] : '';

        if($userlog =='herman' OR $userlog =='lia' OR $userlog =='chiuyun' OR $userlog =='dinda' OR $userlog =='ryan' OR $userlog =='wardi'){
            $akseposting ='Y';
        }else{
            $akseposting ='N';
        }
        $userid =$this->test_input($data["userid"]);
        $tahun =$this->test_input($data["tahun"]);
        $cari = $this->test_input($data["cari"]);
      
        $filterdata ="";
        if($cari !=='NULL'){
           
            $cari_id =$this->isDate($cari);
          
            if($cari_id == true){
                $tgl =date('Y-m-d',strtotime($cari));
              
                $filterdata =$tgl;
          
            }else{
                $filterdata="%".$cari."%";
            }               

        }else{
           $filterdata =$cari; 
        }
        $flagtf ='NULL';
        $query ="SP_TampilListMutasiPostingRAD '".$userid."','".$tahun."','".$flagtf."' ,'".$akseposting."' ,'".$filterdata."' ";
      


        $result2 = $this->db->baca_sql2($query);
        $datas =[];

        while(odbc_fetch_row($result2)){
           
            $datas[] =[
                // "PartId" => rtrim(odbc_result($result2,'PartId')),
                // "PartName" => rtrim(odbc_result($result2,'PartName')),
                // "Quantitery" =>(int)rtrim(odbc_result($result2,'Quantity')),
              
                // "warehouse" => rtrim(odbc_result($result2,'warehouse')),
                "SoTransacID" => rtrim(odbc_result($result2,'SoTransacID')),
                "Shipdate" =>date('d-m-y',strtotime(rtrim(odbc_result($result2,'Shipdate')))),
                "ket" =>rtrim(odbc_result($result2,'SOEntryDesc')),
                "UserId" =>rtrim(odbc_result($result2,'UserId')),
            ];
            }
        $fulldata =[];
          foreach ($datas as $item){
            $fulldata[] =[
                "SoTransacID" => $item['SoTransacID'],
                "Shipdate" => $item['Shipdate'],
                "ket" => $item['ket'],
                "UserId" => $item['UserId'],
                "detail" =>$this->get_Detelmutasi($item['SoTransacID']),
            ];
            
          }
          
           return $fulldata;

       
    }
    private function isDate($date, $format = 'd-m-Y') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    public function ViewSudahposting($data){
        $SoTransacID =$this->test_input($data["SoTransacID"]);
        $query ="SELECT SoTransacID,Shipdate,SOEntryDesc,UserIDEntry,UserId FROM mutasi2 where SoTransacID='".$SoTransacID."'  ";
        $result2 = $this->db->baca_sql2($query);
        while(odbc_fetch_row($result2)){
           
            $datas[] =[
               
                "SoTransacID" => rtrim(odbc_result($result2,'SoTransacID')),
                "Shipdate" =>date('d-m-y',strtotime(rtrim(odbc_result($result2,'Shipdate')))),
                "SOEntryDesc" =>rtrim(odbc_result($result2,'SOEntryDesc')),
                "UserId" =>rtrim(odbc_result($result2,'UserId')),
                "detail" =>$this->get_viewsDetelmutasi($SoTransacID),
            ];
            }

      
            return $datas;

    }



    private function get_viewsDetelmutasi($SoTransacID){
       
        $query="SELECT PartId,PartName,transtype,keterangan,warehouse,warehouse2,Quantity 
		FROM mutasidetail2 where SoTransacID='".$SoTransacID."' ORDER BY Itemno ";

        $result2 = $this->db->baca_sql2($query);

        $datas =[];

        while(odbc_fetch_row($result2)){
           
            $datas[]=[
                "PartId" => rtrim(odbc_result($result2,'PartId')),
                "PartName" => rtrim(odbc_result($result2,'PartName')),
                "Quantity" =>(int)rtrim(odbc_result($result2,'Quantity')),
                "transtype" => rtrim(odbc_result($result2,'transtype')),
                "keterangan" => rtrim(odbc_result($result2,'keterangan')),
                 "warehouse" => rtrim(odbc_result($result2,'warehouse')),
                 "warehouse2" => rtrim(odbc_result($result2,'warehouse2')),

            ];
        }


        // echo "<pre>";
        // print_r($datas);
        // echo "</pre>";
        // die();
    
        return $datas;
    }




    public function UpdateDatatempt($data)
	{
        
            $head = $data["datahead"];
			$userid =$this->test_input($head["userid"]);
			$shipdate =$this->test_input($head["tanggal"]);
			$transnohider =$this->test_input($head["transnohider"]);
			$soentrydesc =$this->test_input($head["keterangan"]);
            $useridenty = $this->test_input($head["userid"]);
            $dateentry =   date("Y-m-d H:i:s");
            //$cekhead =  $this->CekTempHeadr($transnohider);
                 $query ="SP_UPDATE_MUTASI '".$transnohider."','".$shipdate."','".$soentrydesc."','".$dateentry."','".$useridenty."','".$userid."' ";
                 //die(var_dump($query));
                $this->db->baca_sql2($query);
            

         
            $detail = $data["datadetail"];
            $transno =$this->test_input($detail["transno"]);
            $transtype =$this->test_input($detail["transtype"]);
            $refno =$this->test_input($detail["refno"]);
            $warehouse =$this->test_input($detail["warehouse"]);
            $partid =$this->test_input($detail["partid"]);
            $pcs =$this->test_input($detail["pcs"]);
            $comment =$this->test_input($detail["comment"]);
            $batchno =$this->test_input($detail["batchno"]);
       

            $query2 =" SP_INSERT_MUTASIDETAIL '".$transno."','".$partid."','".$transtype."','".$refno."','".$batchno."','".$pcs."',
            '".$comment."','".$warehouse."'";

            // $query2 ="INSERT  INTO $this->tabledetail (SoTransacID,PartId,PartName,transtype,refno,batchno,pcs,keterangan,warehouse,prodclass,product,subprod)
            // VALUES('".$transno."','".$partid."','".$partname."','".$transtype."','".$refno."','".$batchno."','".$pcs."','".$comment."','".$warehouse."','".$prodclass."','".$product."','".$subprod."')";
           
           $this->db->baca_sql2($query2);
		
           return   $this->getdataDetail($transno);
	}

    
}