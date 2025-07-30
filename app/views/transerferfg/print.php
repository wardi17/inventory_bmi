<?php

class FPDF_AutoWrapTable extends FPDF {
      private $data = array();
      private $options = array(
          'filename' => '',
          'destinationfile' => '',
          'paper_size'=>'F4',
          'orientation'=>'P'
      );

    function __construct($data = array(), $options = array()) {
      
       
        parent::__construct();
        $this->data = $data;
        $this->options = $options;
    }

    public function rptDetailData() {
        date_default_timezone_set('Asia/Jakarta');
        // echo "<pre>";
        // print_r($this->data);
        // echo "</pre>";
        // die();
        $border = 0;
        $this->AddPage();
        $this->SetAutoPageBreak(true,60);
        $this->AliasNbPages();
        $left = 25;

        //header
             $SoTransacID ="";
			$Shipdate ="";
			$SOEntryDesc ="";
			$UserId ="";
			$ceridit ="";
		
			 foreach($this->data as $items){
				$SoTransacID = $items['SoTransacID'];
				$Shipdate = $items['Shipdate'];
				$SOEntryDesc = $items['SOEntryDesc'];
				$UserId = $items['UserId'];
			
		
			 }
			
            //  $ket_array =[
            //     'ket_atasan'=>$ket_atasan,
            //     'ket_app' =>$ket_approve,
            //     'ket_app_FAM'=>$ket_app_FAM
            //  ];
           
		
			// setting jenis font yang akan digunakan
			///set font to arial, bold, 14pt
            $this->SetAutoPageBreak(true,30);
            $this->AliasNbPages();
			$this->SetFont('Arial','B',11);

			//Cell(width , height , text , border , end line , [align] )

			$this->Cell(130 ,5,'PT. BEST MEGA INDUSTRI',0,0);
			$this->Cell(59 ,5,'View Transfer FG (Belum Diposting)',0,1);//end of line

			//set font to arial, regular, 12pt
			$this->SetFont('Arial','',10);
			$this->Cell(130 ,5,$SoTransacID,0,0);
			$this->Cell(50 ,5,'Date : '.$Shipdate,0,1);
			//$this->Cell(59 ,5,'',0,1);//end of line
			//$this->Cell(130 ,5,'Type : '.$type,0,0);
			
	
			$this->Cell(189 ,3,'',0,1);//end of line

			$this->SetFont('Arial','',8);
			$this->Cell(130 ,5,'UP : '.$UserId,0,0);
			$this->Cell(50 ,5,'',0,1);//end of line
			//invoice contents
			$this->Cell(0,0.1, '', 1, 1,'C');
			$this->Cell(0,2, '', 0, 1,'C');

			
              $left = 40;
              $left = $this->GetX();
             $h =3;
            $this->SetFont('Arial','B',8);
            $this->SetX($left +=0); $this->Cell(8,$h, 'No', 0, 0);
            $this->SetX($left +=8); $this->Cell(18,$h,'From Whsid', 0, 0);
            $this->SetX($left +=18); $this->Cell(18,$h,'To Whsid', 0, 0);
            $this->SetX($left +=18); $this->Cell(18,$h,'PartId', 0, 0);
            $this->SetX($left +=18); $this->Cell(50,$h,'Part Name', 0, 0);
            $this->SetX($left +=50); $this->Cell(15,$h,'Qty',0, 0);
            $this->SetX($left +=15); $this->Cell(70,$h,'Comment',0, 1);
             $this->Cell(0,2, '', 0, 1,'C');
			 $this->Cell(0,0.1, '',1, 1,'C');
            $this->SetFont('Arial','',8);
            $this->SetDrawColor(255,255,255);
            $this->SetWidths(array(8,18,18,18,50,15,70));
            $this->SetAligns(array('L','L','L','L','L','L','L'));

            $no = 1; $this->SetFillColor(255);
            foreach($this->data as $baris){
                
                $detail = $baris["detail"] ;
              //die(var_dump($detail));
                foreach($baris["detail"] as $item){
                     $this->Row(
                array(
                    $no++,
                    $item['warehouse'],
                    $item['warehouse2'],
                    $item['PartId'],
                    $item['PartName'],
                    $item['Quantity'],
                    $item['keterangan'],
                ));
                }
             
              
            }
            $this->Cell(0,0.1, '', 1, 1,'C');
			$this->Cell(0,2, '', 0, 1,'C');
            
			$this->SetFont('Arial','',8);
			$this->Cell(130 ,5,'Notes : '.$SOEntryDesc,0,0);
			$this->Cell(50 ,5,'',0,1);//end of line
         
          

    }


    public function printPDF () {

        if ($this->options['paper_size'] == "F4") {
            $a = 8.3 * 72; //1 inch = 72 pt
            $b = 13.0 * 72;
            //$pdf = new FPDF($this->options['orientation'], "pt", array($a,$b));
             new FPDF($this->options['orientation'], "pt", array($a,$b));
          
        } else {
            $this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
        }

        $this->SetAutoPageBreak(false);
        $this->AliasNbPages();
        $this->SetFont("helvetica", "B", 10);
        //$this->AddPage();

        $this->rptDetailData();
        $this->Output($this->options['filename'],$this->options['destinationfile']);
      }

    private $widths;
    private $aligns;

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data)
    {
  
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
       
        $h=8*$nb;

        //Issue a page break first if needed
        $this->CheckPageBreak($h);

        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();

            //Draw the border
            $this->Rect($x,$y,$w,$h);

            //Print the text
            $this->MultiCell($w,8,$data[$i],0,$a);

            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }

        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {
        
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;

        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }

    private function replace_name($data){
        $replace = str_replace("&amp;","",$data);
        return $replace;
    }
} //end of class

#ambil data dari DB dan masukkan ke array
// $data = array();
// $query=mysqli_query($conn, "SELECT * FROM keluhan INNER JOIN pelanggan ON keluhan.idpelanggan = pelanggan.idpelanggan
//                             INNER JOIN teknisi ON keluhan.idteknisi = teknisi.idteknisi ");
//         while($row=mysqli_fetch_array($query)){
//         array_push($data, $row);
// }

//pilihan
$options = array(
    'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
    'destinationfile' => '', //I=inline browser (default), F=local file, D=download
    'paper_size'=>'F4',    //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation'=>'P' //orientation: P=portrait, L=landscape
);


$tabel = new FPDF_AutoWrapTable($data, $options);

$tabel->printPDF();
?>