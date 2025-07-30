<?php


class TransTypeModel{
    private $tabletampt = 'cacheOrder';
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
           
			$email =$this->test_input($data["email"]);
			$harga =$this->test_input($data["harga"]);
			$partid =$this->test_input($data["partid"]);
			$partname =$this->test_input($data["partname"]);
			$qty =$this->test_input($data["qty"]);
			$satuan =$this->test_input($data["satuan"]);
            $isi =$this->test_input($data["isi"]);
            $disckon =$this->test_input($data["disc"]);
            $harga_asli =$this->test_input($data["harga_asli"]);
			$cek =0;

			$sql="INSERT INTO $this->tabletampt (harga_asli,email,partid,qty,harga,partname,satuan,isi,diskon) 
			Values ('".$harga_asli."','".$email."','".$partid."','".$qty."','".$harga."','".$partname."','".$satuan."','".$isi."','".$disckon."')"; 

			
			$result = $this->db->baca_sql($sql);
			if(!$result){
			$cek =$cek+1;
			}
		
			if ($cek==0){
			$status['nilai']=1; //bernilai benar
			$status['error']="Data Berhasil Ditambahkan";
			}else{
			$status['nilai']=0; //bernilai benar
			$status['error']="Data Gagal Ditambahkan";
			}	
			
		return $status;

		
	}


    public function TampilDataType(){

        //$email = $this->test_input($data['email']);

    $query = "SP_GetTransType";
    $result = $this->db->baca_sql2($query);

    $datafull =[];
    while(odbc_fetch_row($result)){
        $datafull[] =[
            "code"=>rtrim(odbc_result($result,'code')),
            "description"=>rtrim(odbc_result($result,'description')),
        ];
    }

   /*echo "<pre>";
    print_r($datafull);
     echo "</pre>";
    die();*/
    return $datafull;
}



    public function TampilDataWarehouse(){

            //$email = $this->test_input($data['email']);
        $query = "SP_GetWarehouse";
        $result = $this->db->baca_sql2($query);

        $datafull =[];
        while(odbc_fetch_row($result)){
            $datafull[] =[
                "whsid"=>rtrim(odbc_result($result,'WHSID')),
                "whsname"=>rtrim(odbc_result($result,'WHSID')).' |'.rtrim(odbc_result($result,'WHSName')),
            ];
        }

        /* echo "<pre>";
        print_r($datafull);
        echo "</pre>";
        die();*/
        return $datafull;
        }



        public function TampilDatapartid($data){
        
            $filter = $data["filter"];
            $filtertrim = $this->test_input($filter);
      
            $filterdata =$filtertrim."%";
         

            $query = "SP_Getpartid '".$filterdata."'";
            //die(var_dump($query));
            $result = $this->db->baca_sql2($query);

            $datafull =[];
        
            while(odbc_fetch_row($result)){
                $datafull[] =[
                    "partid"=>rtrim(odbc_result($result,'partid')),
                    "partname"=>rtrim(odbc_result($result,'partid')).' |'.rtrim(odbc_result($result,'partname'))
                ];

            
            }


			 array_walk_recursive($datafull, function(&$value) {
				if (is_string($value)) {
					$value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
				}
			});

       /*    echo "<pre>";
            print_r($datafull);
            echo "</pre>";
            die();*/
            return $datafull;
        }


        public function TampilDataPatid2(){
        
           
         
            $query = "SELECT  partid,partname,prodclass,subprod,product FROM partmaster  where parttype='FG' AND divisi=1 order by partid ASC";
            $result = $this->db->baca_sql2($query);

            $datafull =[];
        
            while(odbc_fetch_row($result)){
                $datafull[] =[
                    "partid"=>rtrim(odbc_result($result,'partid')),
                    "partname_asli"=>rtrim(odbc_result($result,'partname')),
                    "partname"=>rtrim(odbc_result($result,'partid')).' |'.rtrim(odbc_result($result,'partname')),
                    "prodclass"=>rtrim(odbc_result($result,'prodclass')),
                    "subprod"=>rtrim(odbc_result($result,'subprod')),
                    "product"=>rtrim(odbc_result($result,'product')),
                ];

            
            }

           /* echo "<pre>";
            print_r($datafull);
            echo "</pre>";
            die();*/
            return $datafull;
        }


















 

}