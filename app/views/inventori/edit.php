
<?php
$transtype =$data["transtype"];
$wherhouse =$data["wherhouse"];

$SoTransacID = $data["SoTransacID"];

$userlog = $data["userid"];


?>

<style>

    .error {
      color: red;
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
                            <h5 class="text-center">Edit Data</h5>
                            </div>
                          </div>
                        
                        </div>
                          <div class="card-body">
                              <div class=" row col-md-12">
                              <div class="col-md-6">
                                    <div class="row mb-12 mb-2">
                                        <label for="transnoHider" style="width: 20%;" class="col-sm-2 col-form-label">Transno</label>
                                        <div class="col-sm-6">
                                          <input disabled type="text"  id="transnoHider" value="<?=$SoTransacID?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-12 mb-2">
                                        <label for="tanggal" style="width: 20%;" class="col-sm-2 col-form-label">Tanggal</label>
                                        <div  style="width: 35%;"  class="col-sm-6">
                                          <input   type="date" id="tanggal" class="form-control">
                                        </div>
                                    </div>

                              </div>
                              <div class="col-md-6">
                                    <div class="row mb-12 mb-2">
                                        <label for="keterangan"style="width:25%;" class="col-sm-3 col-form-label">Keterangan</label>
                                        <div class="col-sm-6">
                                          <textarea type="text"  style="width:150%;" id="keterangan" class="form-control"></textarea>
                                          <span id="keteranganError" class="error"></span>
                                        </div>
                                    </div>
                              </div>
                            </div>
                      </div>
                  </div>

                <div class="card mt-4">
                          <div class="card-body">
                            <h5 class="text-primary mb-2">Detail</h5> 
                            <div class="row col-md-12">
                              <div class="col-md-6">
                                    <div class="row mb-12 mb-2">
                                        <label for="transtype"style="width:23%;" class="col-sm-3 col-form-label">Trans Type</label>
                                                  <div  class=" col-sm-6">
                                                              <select class="form-control" id="transtype">
                                                              <option value="" disabled selected>Please Select</option>
                                                              <?php  foreach($transtype as $file):
                                                                          $kode = $file['code'];
                                                                          $nama = $file['description'];

                                                                      ?>
                                                            <option value="<?= $kode ?>"><?= $nama ?></option>
                                                              <?php endforeach;?> 
                                                            </select>
                                                                  <span id="transtypeError" class="error"></span>
                                                          </div>
                                    </div>

                                      <div class="row mb-12 mb-2">
                                        <label for="warehouse"style="width:23%;" class="col-sm-3 col-form-label">Warehouse</label>
                                                  <div  class="col-sm-8">
                                                                  <select class="form-control" id="warehouse">
                                                                  <option value="" disabled selected>Please Select</option>
                                                              <?php  foreach($wherhouse as $file):
                                                                          $kode = $file['whsid'];
                                                                          $nama = $file['whsname'];

                                                                      ?>
                                                            <option value="<?= $kode ?>"><?= $nama ?></option>
                                                              <?php endforeach;?> 
                                                            </select>
                                                                  <span id="warehouseError" class="error"></span>
                                                          </div>
                                      </div>
                                        
                                      <div class="row mb-12 mb-2">
                                            <label for="refNo"style="width:23%;" class="col-sm-3 col-form-label">Ref No</label>
                                            <div class="col-sm-6">
                                          
                                              <input type="text" id="refNo" class="form-control">
                                              <span id="refNoError" class="error"></span>
                                            </div>
                                      </div>
                                        <div class="row mb-12 mb-2">
                                            <label for="BatchNo"style="width:23%;" class="col-sm-3 col-form-label">Batch No</label>
                                            <div class="col-sm-6">
                                              <input type="text" id="BatchNo" class="form-control">
                                              <span id="BatchNoError" class="error"></span>
                                            </div>
                                        </div>
                              
                                </div>
                                  <!-- batas row -->
                                  <div class="col-md-6">
                        
                                        <div class="row mb-12 mb-2">
                                            <label for="partid" style="width:25%;" class="col-sm-2 col-form-label">Part Id</label>
                                            <div class="col-sm-4">
                                            <input type="text" class="form-control" id="partid"></input>
                                            <span id="partidError" class="error"></span>
                                            </div>
                                            
                                        </div>
                                        <div class="row mb-12 mb-2">
                                              <label for="partname" style="width:25%;" class="col-sm-2 col-form-label">Part Name</label>
                                                  <div  class="col-sm-8">
                                                  <select class="form-control" id="partname"></select>
                                                <span id="partnameError" class="error"></span>
                                                                </div>
                                        </div>
                                        <div class="row mb-12 mb-2">
                                        <label for="pcs" style="width:25%;" class="col-sm-2 col-form-label">Qty (Pcs)</label>
                                            <div class="col-sm-4">
                                              <input type="number" min=0 id="pcs" value=0 class="form-control">
                                              <span id="pcsError" class="error"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-12 mb-2">
                                          <label for="comment"style="width:25%;" class="col-sm-3 col-form-label">Comment</label>
                                          <div class="col-sm-6">
                                            <textarea type="text"  style="width:150%;" id="comment" class="form-control"></textarea>
                                            <span id="commentError" class="error"></span>
                                          </div>
                                    </div>
                                    </div>
                              </div>
                            </div>
                                  
                                <div class="text-center">
                                      <button  class="btn btn-primary me-1 mb-3" id="CreateAdd">Add</button>
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
          //  let splite =datfilte.split('|');
          //  let partid = splite[0];
           //let partname = splite[1];
            $("#partid").val(partid);
        
      });
      //GetdataSelect(userid);
  
   $("#CreateAdd").on("click",function(event){
    event.preventDefault();
  
     let data =validasiinput(event);
      if(data !==false){
        $("#itemTabel").show();
        $("#CreateAdd").fadeOut();
        $.ajax({
                url:"<?=base_url?>/Inventoriiad/Updatedata",
                method:"POST",
                dataType: "json",
                data:data,
                success:function(result){
                  //$("#keterangan").val("");
                  $("#partid").val("");
                  $("#partname").val("");
                  $("#refNo").val("");
                  $("#BatchNo").val("");
                  $("#comment").val("");
                  $("#pcs").val(0);
                  getListItem();
                  setData(result);
                }
        });
      }else{
        Swal.fire({
          position: "top-center",
          icon: "info",
          title: "ada data yang belum di isi",
          showConfirmButton: true,
          //timer: 1500
        });
        
      }
 
    });
    getValidasiData();
  }else{
    Swal.fire({
                position: 'top-center',
                icon: "info",
                title:"Anda Belum Login Silahkan Login dulu !!",
                showConfirmButton: true,
                  //timer: 1500
                }).then(function(){ 
                  window.location.replace("<?=base_urllogin?>");
                });
  }


  });
  // and document ready

  function SetTanggal(){
    var d = new Date();
      var month = d.getMonth()+1;
      var day = d.getDate();
      let  output =  d.getFullYear() +'-'+
					(month<10 ? '0' : '') + month + '-' +
				 (day<10 ? '0' : '') + day;

    $("#tanggal").val(output);
      
      //  getTransType();
      //  getWarehouse();
      
  }





  function getPartid(partid){
      $("#partname").val("");
      $("#partname").empty();
    $.ajax({
                url:"<?=base_url?>/Inventoriiad/getpartid",
                method:"POST",
                dataType: "json",
                data:{filter:partid},
                success:function(result){
                  if(result !== null){
                    $.each(result,function(key,value){
                      let partname_asli = value.partid;
                        let partname = value.partname;
                        $("#partname").append($('<option/>').val(partname_asli).html(partname));  
                      });
          
                      let partid = $("#partname").val();
                        $("#partid").val(partid);
                  }else{
                    Swal.fire({
                      position: "top-center",
                      icon: "info",
                      title: "partid yang di input tidak ada",
                      showConfirmButton: true,
                      //timer: 1500
                    });
                  }

        
                }
    });


  }





  
  function SetTransno(){

   
    var currentDate = new Date();
    // Format the date using moment.js
      var formattedDate = moment(currentDate).format("YYYY-MM-DD HH:mm:ss");
    
      let split =formattedDate.split("-");
      let thn = split[0].substr(2,2);
      let bln = split[1];
      let tgl = split[2];
      let rep_tgl = tgl.replace(" ","");
      let rep_tgl2 = rep_tgl.replace(":","");
      let rep_tgl3 = rep_tgl2.replace(":",""); 

      let id_trns ="FG"+thn+bln+rep_tgl3;


      $("#transnoHider").val(id_trns);
    
  
  }



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
      <button type="btn" onclick="Deletedata()";  class="btn btn-danger">Hapus</button>
      </div>
      </div>
      
  </div>`;
  $("#itemTabel").empty().html(item);
  }


  function setData(result){
    $("#CreateAdd").fadeIn();
    $("#edit_row").fadeIn();
    $("#delete").fadeIn();
    $("#loadingModal").hide();
    const transno =$("#transnoHider").val();
    let datatabel = ``;


    datatabel +=`
                 <table id="tabel1" class='table table-striped table-hover' style='width:100%'>                    
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
                                                            <th>Edit</th>
                                                            <th>Delete</th>
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
                  <td>${b.keterangan}</td>`;
        datatabel +=`<td><button   id="edit_row" 
		data-transno="${transno}" data-itemno="${b.Itemno}" data-transtype="${b.transtype}" data-warehouse="${b.warehouse}"
		data-batchno="${b.batchno}" data-Refno="${b.Refno}" data-partid="${b.PartId}" data-quantity="${b.Quantity}"data-keterangan="${b.keterangan}"
		class="btn"><i class="fa-regular fa-pen-to-square  text-info"></i></i></button></td>`;            
        datatabel +=`<td><button  id="delete" onclick="delete_row('${transno}','${b.Itemno}');" class="btn"><i class="fa-solid fa-trash-can text-danger "></i></button></td>`;            

                  datatabel +=`</tr>`;
    });
    datatabel +=`</tbody></table>`;
    $("#tabellist").empty().html(datatabel);

     setdatatabel();
    //tabel();
  }

	function setdatatabel(){
		$('#tabel1').DataTable({
		"order": [[ 1, "desc" ]], //or asc 
			"columnDefs" : [{"targets":1, "type":"date-eu"}],
		});
	}

  $(document).on("click","#edit_row",function(){
	 const transno = $(this).data("transno");
	 const Itemno = $(this).data("itemno");
	 const transtype = $(this).data('transtype');

	 const warehouse = $(this).data("warehouse");
	 const batchno = $(this).data("batchno");
	 const Refno = $(this).data("refno");
	 const PartId = $(this).data("partid");
	 const Quantity = $(this).data("quantity");
	 const keterangan = $(this).data("keterangan");
	
	  $("#edit_row").fadeOut();
	  $("#delete").fadeOut();
	  
	   console.log(PartId);
	   $("#transtype").val(transtype).change();

	  $("#warehouse").val(warehouse).change();
	  $("#refNo").val(Refno);
	  $("#BatchNo").val(batchno);
	  $("#pcs").val(Quantity);
	  $("#comment").val(keterangan);
	  getPartid(PartId);
	    const datas ={
		"transno":transno,
		"itemno":Itemno
	  }
    $.ajax({
                url:"<?=base_url?>/inventoriiad/deletdatarow",
                method:"POST",
                dataType: "json",
                data:datas,
                success:function(result){
                   setData(result);
                }
    });
  });  
	  
  /* function edit_row(transno,itemno,transtype,warehouse,batchno,Refno,PartId,Quantity,keterangan){
	  console.log(transno);
  $("#edit_row").fadeOut();
  $("#delete").fadeOut();
  $("#transtype").val(transtype);
  $("#warehouse").val(warehouse);
  $("#refNo").val(Refno);
  $("#BatchNo").val(batchno);
  $("#pcs").val(Quantity);
  $("#comment").val(keterangan);
  getPartid(PartId);


  const data ={
    transno:transno,
    itemno:itemno
  }
 $.ajax({
                url:"<?=base_url?>/inventoriiad/deletdatarow",
                method:"POST",
                dataType: "json",
                data:data,
                success:function(result){
                   setData(result);
                }
    });
  } */

function delete_row(transno,itemno){
  $("#delete").fadeOut();
  const data ={
    transno:transno,
    itemno:itemno
  }
  $.ajax({
                url:"<?=base_url?>/inventoriiad/deletdatarow",
                method:"POST",
                dataType: "json",
                data:data,
                success:function(result){
                   setData(result);
                }
    });
  }





function Deletedata(){
  let userid = "<?=trim($userlog)?>";
      const transno =$("#transnoHider").val();


      const data ={
        transno:transno,
        userid:userid
      }
      Swal.fire({
                title: "Apakah Anda Yakin ini",
                text: "Batal Data Ini!",
                type: "warning",
                showDenyButton: true,
                confirmButtonColor: "#93C54B",
                denyButtonColor: "#757575",
                confirmButtonText: "Ya,Hapus",
                denyButtonText: "Tidak",
              }).then((result) =>{
                 if(result.isConfirmed){
                  $("#itemTabel").hide();
                  $("#loadingModal").show();
                  $.ajax({
                    url:"<?=base_url?>/inventoriiad/deletdataall",
                    method:"POST",
                    dataType: "json",
                    data:data,
                    success:function(result){
                      goBack();
                    }
        });
                 }
              })

}



function Submitdata(){
      let userid = "<?=trim($userlog)?>";
      const transno =$("#transnoHider").val();
      if(userid ==''){
        Swal.fire({
                      position: "top-center",
                      icon: "info",
                      title: "partid yang di input tidak ada",
                      showConfirmButton: true,
                      //timer: 1500
                    });
      }else if(transno ==''){
        Swal.fire({
                      position: "top-center",
                      icon: "info",
                      title: "partid yang di input tidak ada",
                      showConfirmButton: true,
                      //timer: 1500
                    });
      }else{
            goBack();     
      }
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


function getValidasiData(){
			
      $("#transtype").blur(function() {
       let transtype = $(this).val();
       if (transtype ==="" || transtype === undefined) {
         $("#transtypeError").text("transtype harus diisi");
       } else {
         $("#transtypeError").text("");
       }
       });
   
   
        $("#warehouse").blur(function() {
            let warehouse = $(this).val();
            if (warehouse ==="" || warehouse === undefined){
              $("#warehouseError").text("warehouse harus diisi");
            } else {
              $("#warehouseError").text("");
            }
            });
       
        $("#partid").blur(function() {
            let partid = $(this).val();
            if (partid ===""){
              $("#partidError").text("partid harus diisi");
            } else {
              $("#partidError").text("");
            }
            });
       
      $("#partname").blur(function() {
          let partname = $(this).val();
          if (partname ==="" || partname === undefined){
            $("#partnameError").text("partname harus ada isi nya");
          } else {
            $("#partnameError").text("");
          }
          });
       
      $("#pcs").blur(function() {
          let pcs = $(this).val();
          if (pcs ==="" || pcs === undefined){
            $("#pcsError").text("pcs harus ada isi nya");
          } else {
            $("#pcsError").text("");
          }
          });
 }
</script>