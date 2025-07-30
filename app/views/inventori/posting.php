
<?php
$transtype =$data["transtype"];
$wherhouse =$data["wherhouse"];

$SoTransacID = $data["SoTransacID"];

$userlog = $data["userid"];

?>

<style>
      input[type="file"]{
        display: none;
    }
    .error {
      color: red;
    }

    .ldBar path.mainline {
    stroke-width: 10;
    stroke: #09f;
    stroke-linecap: round;
  }
  .ldBar path.baseline {
    stroke-width: 14;
    stroke: #f1f2f3;
    stroke-linecap: round;
    filter:url(#custom-shadow);
  }

  .loading-spinner{
  width:30px;
  height:30px;
  border:2px solid indigo;
  border-radius:50%;
  border-top-color:#0001;
  display:inline-block;
  animation:loadingspinner .7s linear infinite;
}
@keyframes loadingspinner{
  0%{
    transform:rotate(0deg)
  }
  100%{
    transform:rotate(360deg)
  }
}

.wrap-text {
  word-wrap: break-word;   /* Untuk browser yang lebih lama */
  overflow-wrap: break-word; /* Untuk browser modern */
  white-space: normal;      /* Memungkinkan pembungkusan teks */
}
  </style>
<div id="main">
       <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
    <!-- Content Header (Page header) -->
    <div class ="col-md-12 col-12">
                <!-- Default box -->
                      <div class="card">
                        <div class="card-header">
                          <div class="row col-md-12">
                            <div class="col-md-1">
                            <button onclick="goBack()" type="button" class="btn btn-lg text-start"><i class="fa-solid fa-chevron-left"></i></button>
                            </div>
                            <div class ="col-md-11">
                            <h5 class="text-center">Posting Data</h5>
                            </div>
                          </div>
                        
                        </div>
                          <div class="card-body">
                              <div class=" row col-md-12">
                              <div class="col-md-6">
                                    <div class="row mb-12 mb-2">
                                        <label for="transnoHider" style="width: 20%;" class="col-sm-2 col-form-label">Transno</label>
                                        <div class="col-sm-6">
                                          <input disabled type="text" id="transnoHider" value="<?=$SoTransacID?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-12 mb-2">
                                        <label for="tanggal" style="width: 20%;" class="col-sm-2 col-form-label">Tanggal</label>
                                        <div  style="width: 35%;"  class="col-sm-6">
                                          <input disabled  type="date" id="tanggal" class="form-control">
                                        </div>
                                    </div>

                              </div>
                              <div class="col-md-6">
                                    <div class="row mb-12 mb-2">
                                        <label for="keterangan" style="width: 25%;" class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-6">
                                          <textarea disabled type="text" style="width:150%;" id="keterangan" class="form-control"></textarea>
                                          <span id="keteranganError" class="error"></span>
                                        </div>
                                    </div>
                              </div>
                            </div>
                      </div>
                  </div>

               
              <div id="itemTabel" class="table-responsive"></div>                                                  
              </div>
          </div>
                                                       

  <!-- /.content-wrapper -->
     <!-- Modal loadingModal -->
     <div class="modal " id="loadingModal" data-backdrop="static">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-body text-center">
                    <div class="">
                    <img src="<?=base_url?>/dist/loading.gif" alt="Loading..." width="50" height="50">
                    </div>
                    <div>Loading</div>
                  </div>
                </div>
              </div>
            </div>
            <!--and modal -->




<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Minus data</h5>
        <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="TabelMines"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  <script>
  $(document).ready(function(){

    const userid ="<?= trim($userlog)?>";
    if(userid !==""){

    const SoTransacID ="<?= trim($SoTransacID)?>";
    GetkodeTransada(userid,SoTransacID);
 
    $("#partid").on("change",function(){
      const partid = $(this).val();
       getPartid(partid);
    
    });
    

    $("#partname").on("change",function(){
           const partid = $(this).val();
            $("#partid").val(partid);
        
      });
      //GetdataSelect(userid);
  
}


  
  });
  // and document ready








  




  function validasiinput(event){
   const keterangan = $("#keterangan").val();
		/*	if (keterangan === "") {
			  $("#keteranganError").text("keterangan harus diisi");
			  event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
			} else {
			  $("#keteranganError").text("");
			} */


      const transtype = $("#transtype").find(":selected").val();
			if (transtype === "" || transtype === undefined) {
			  $("#transtypeError").text("transtype harus Pilih");
			  event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
			} else {
			  $("#transtypeError").text("");
			}


   const refNo = $("#refNo").val();
		 /*  	if (refNo === "") {
			  $("#refNoError").text("refNo harus diisi");
			  event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
			} else {
			  $("#refNoError").text("");
			}
		*/

      const BatchNo = $("#BatchNo").val();
		 /* 	if (BatchNo === "") {
			  $("#BatchNoError").text("BatchNo harus diisi");
			  event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
			} else {
			  $("#BatchNoError").text("");
			} */


      const warehouse = $("#warehouse").find(":selected").val();
			if (warehouse === "" || warehouse === undefined) {
			  $("#warehouseError").text("warehouse harus Pilih");
			  event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
			} else {
			  $("#warehouseError").text("");
			}

      const partid = $("#partid").val();
			if (partid === "") {
			  $("#partidError").text("partid harus Pilih");
			  event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
			} else {
			  $("#partidError").text("");
			}

      const pcs = $("#pcs").val();
			if (pcs === "") {
			  $("#pcsError").text("Qty harus diisi");
			  event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
			}else if(pcs =="0"){
				$("#pcsError").text("Qty  tidak boleh 0");
			}else {
			  $("#pcsError").text("");
			}
			
			
     const comment = $("#comment").val();
      /* 
			if (comment === ""){
			  $("#commentError").text("comment harus diisi");
			  event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
			} else {
			  $("#commentError").text("");
			} */


		const partname = $("#partname").find(":selected").val();
		
			if (partname === "" || partname === undefined) {
			  $("#partnameError").text("partname harus ada isi nya");
			  event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
			} else {
			  $("#partnameError").text("");
			}
      const userid = "<?= trim($userlog)?>";
      const tanggal = $("#tanggal").val();
      const transnoHider = $("#transnoHider").val();
      const transno = $("#transno").val();
     

	
		
      if(transtype !=="" && transtype !==undefined && warehouse !== "" && warehouse !== undefined &&
      partid !== "" && pcs !== "" && pcs !=='0' &&  partname !=="" && partname !==undefined ){

          const datahead ={
            userid:userid,
            tanggal:tanggal,
            transnohider:transnoHider,
            keterangan:keterangan,

          }
          const datadetail ={
            transno:transnoHider,
            transtype:transtype,
            refno:refNo,
            batchno:BatchNo,
            warehouse:warehouse,
            partid:partname,
            pcs:pcs,
            comment:comment,
         

          }
          let fulldata ={
            datahead:datahead,
            datadetail:datadetail
          }
         //console.log(fulldata);
          return  fulldata;
      }else{
          return false;
      }
  }



 
  function  GetkodeTransada(userid,SoTransacID){
    $("#loadingModal").show();
      $.ajax({
                  url:"<?=base_url?>/Inventoriiad/Tampildata",
                  data:{userid:userid,SoTransacID:SoTransacID},
                  method:"POST",
                  dataType: "json",
                  success:function(result){
                     const datahead = result.datahider;
                     const datadetail = result.datadetail;
                    
                   
                      getListItem();
                      SetdataHider(datahead);
                      SetdataDetail(datadetail);
                     
  
                  }
      });

  }



   function SetdataHider(datahead){
                let SOEntryDesc ="";
                let Shipdate="";
              $.each(datahead,function(key,value){
                    SOEntryDesc = value.SOEntryDesc;
                    Shipdate = value.Shipdate;
                  });

              $("#tanggal").val(Shipdate);
              $("#keterangan").val(SOEntryDesc);
   }




function  SetdataDetail(datadetail){
                setData(datadetail);
       
          
} 

function getListItem(){
     const item =`<div class="card mt-2">
      <div class="card-body">
      <div id="tabellist"></div>
      <div class="text-center"> 
      <button type="btn"  onclick="Submitdata()"; class="btn btn-primary">Submit</button>
      <button type="btn" onclick="goBack()";  class="btn btn-secondary">Batal</button>
      </div>
      </div>
      
  </div>`;
  $("#itemTabel").empty().html(item);
  }


  function setData(result){
    $("#CreateAdd").fadeIn();
    $("#delete").fadeIn();
    $("#loadingModal").hide();
    const transno =$("#transnoHider").val();
    let datatabel = ``;


    datatabel +=`
                 <table id="tabel1" class='table-responsive' style='width:100%'>                    
                                      <thead  id='thead'class ='thead'>
                                                <tr>
                                                            <th>No</th>
                                                            <th>Trans type</th>
                                                            <th>Warehouse</th>
                                                            <th>Refno</th>
                                                            <th>Batchno</th>
                                                            <th>PartId</th>
                                                            <th>Part Name</th>
                                                            <th>Pcs</th>
                                                            <th>Comment</th>
                                                            
                                                </tr>
                                                
                                                </thead>
                                                <tbody>
                                          
    `;
     let no =1;
    $.each(result,function(a,b){
      let status_document = b.status_document;
      let nama_document = b.nama_document;
      // $("#stdocument").val(status_document);
      // let status_gambar =0;

      datatabel +=`
                  <td>${no++}</td>
                  <td>${b.transtype}</td>
                  <td>${b.warehouse}</td>
                  <td>${b.Refno}</td>
                  <td>${b.batchno}</td>
                  <td>${b.PartId}</td>
                  <td>${b.PartName}</td>
                  <td>${b.Quantity}</td>
                  <td class="wrap-text">${b.keterangan}</td>`;

                  datatabel +=`</tr>`;
    });
    datatabel +=`</tbody></table>`;
    $("#tabellist").empty().html(datatabel);
setdatatabel();
  
    //tabel();
  }



	function setdatatabel(){
		$('#tabel1').DataTable({
		"order": [[0, "asc" ]], //or asc 
			"columnDefs" : [{"targets":1, "type":"date-eu"}],
		});
	}








function Submitdata(){
      let userid = "<?=trim($userlog)?>";
      const transno =$("#transnoHider").val();

      const data ={
        userid:userid,
        transno:transno
      };

      
      $.ajax({
                    url:"<?=base_url?>/inventoriiad/postingsave",
                    method:"POST",
                    dataType: "json",
                    data:data,
                    beforeSend: function(){
                      Swal.fire({
                        title: 'Loading',
                        html: 'Please wait...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                        Swal.showLoading()
                    }
                        });
                    },
                    success:function(result){
                      const status = result.error;
                      let nilai = result.nilai;
                      if(nilai ==2){
                        Swal.fire({
                                  position: 'top-center',
                                icon: 'info',
                                title:'Ada Stock minus',
                                showConfirmButton: true,
                                //timer:1500
                                }).then(function(){ 
                                  tampilsockmines(status);
                                  //goBack();
                              });
                      }else{
                        Swal.fire({
                                  position: 'top-center',
                                icon: 'success',
                                title: status,
                                showConfirmButton: true,
                                //timer:1500
                                }).then(function(){ 
                                  goBack();
                              });
                      }
                            
                            
                    }
        });

}



function tampilsockmines(status){
  $("#staticBackdrop").modal('show');
  tabelmens();
  setDatateble(status);

}

  function tabelmens(){
    let tabel =`     <table id="tabelwar" class="display table-info" style="width:100%">                    
                                  <thead  id='thead'class ='thead'>
                                  <tr>      
                                             <th>Trans Type</th>
                                             <th>PartId</th>
                                             <th>PartName</th>
                                             <th>Qty</th>
                                             <th>Stock</th>
                                             <th>Selisih</th>
                                             <th>Warehouse</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                              </table><br>`;
      $("#TabelMines").empty().html(tabel);
  }


function setDatateble(status){
          $("#tabelwar").DataTable({
                            
                            "ordering": false,
                            "destroy":true,
                            // dom: 'Plfrtip',
                            //     scrollCollapse: true,
                            paging:true,
                            //     "bPaginate":false,
                            //     "bLengthChange": false,
                            //     "bFilter": true,
                            //     "bInfo": false,
                            //     "bAutoWidth": false,
                            //     dom: 'lrt',
                                fixedColumns:   {
                                // left: 1,
                                    right: 1
                                },
                                pageLength: 5,
                                lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                                            
                                data: status,
                                'rowCallback': function(row, data, index){
                                 
                                      let status_stok = data.Status_stok;
                                     
                                      if(status_stok == "kurang"){
                                        $(row).find('td:eq(0)').css("background-color","#FF8E8F");
                                        $(row).find('td:eq(1)').css("background-color","#FF8E8F");
                                        $(row).find('td:eq(2)').css("background-color","#FF8E8F");
                                        $(row).find('td:eq(3)').css("background-color","#FF8E8F");
                                        $(row).find('td:eq(4)').css("background-color","#FF8E8F");
                                        $(row).find('td:eq(5)').css("background-color","#FF8E8F");
                                        $(row).find('td:eq(6)').css("background-color","#FF8E8F");
						                            $(row).find('td:eq(0)').css('color', 'black');
                                        $(row).find('td:eq(1)').css('color', 'black');
                                        $(row).find('td:eq(2)').css('color', 'black');
                                        $(row).find('td:eq(3)').css('color', 'black');
                                        $(row).find('td:eq(4)').css('color', 'black');
                                        $(row).find('td:eq(5)').css('color', 'black')
                                        $(row).find('td:eq(6)').css('color', 'black')
                                      }else{
                                     /*   $(row).find('td:eq(0)').css("background-color","#3cb371");
                                        $(row).find('td:eq(1)').css("background-color","#3cb371");
                                        $(row).find('td:eq(2)').css("background-color","#3cb371");
                                        $(row).find('td:eq(3)').css("background-color","#3cb371");
                                        $(row).find('td:eq(4)').css("background-color","#3cb371");
                                        $(row).find('td:eq(5)').css("background-color","#3cb371");
                                        $(row).find('td:eq(6)').css("background-color","#3cb371");
						                            $(row).find('td:eq(0)').css('color', 'white');
                                        $(row).find('td:eq(1)').css('color', 'white');
                                        $(row).find('td:eq(2)').css('color', 'white');
                                        $(row).find('td:eq(3)').css('color', 'white');
                                        $(row).find('td:eq(4)').css('color', 'white');
                                        $(row).find('td:eq(5)').css('color', 'white');
                                        $(row).find('td:eq(6)').css('color', 'white'); */
                                      }
                                  },
                                    columns: [
                                        {'data' : 'transtype'},
                                        { 'data': 'PartId' },
                                        { 'data': 'PartName' },
                                        { 'data': 'Quantity' },
                                        { 'data': 'stock_max' },
                                        {'data':'selisih'},
                                        { 'data': 'warehouse' },
                                        // { "render": function ( data, type,row) { // Tampilkan kolom aksi
                                        
                                        //   let div = row.kode_divisi;
                                        //   let html  =`<button type="button"   class=" open-edit btn btn-lg btn-space" data-bs-toggle="modal" data-bs-target="#EditModal"><i class="fa-regular fa-pen-to-square"></i></button>`

                                        // html += `<button type="button" class=" open-delete  btn  btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-regular fa-trash-can"></i></button>`
                                        // html += `<button type="button" onclick ="member_div('${div}')"class="btn  btn-lg"><i class="fa-solid fa-binoculars"></i></button>`

                                        // return html
                                        // }
                                        // },
                                    ]      
                        
                        });
}

function risettabel(){
  $("#loadingModal").hide();
  $("#transtype").val();
  $("#warehouse").val();
  // $("#transtype").prepend("<option value='' selected disabled>Please Select</option>");
  // $("#warehouse").prepend("<option value='' selected disabled>Please Select</option>");
                    $("#keterangan").val("");
                      $("#partid").val("");
                      $("#partname").val("");
                      $("#refNo").val("");
                      $("#BatchNo").val("");
                      $("#comment").val("");
                      $("#pcs").val(0);
                      SetTransno();
                      SetTanggal();
}



 
function goBack(){
                window.location.replace("<?=base_url?>/inventori/index");
            } 



</script>