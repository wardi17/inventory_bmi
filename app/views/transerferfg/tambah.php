
<?php

$wherhouse =$data["wherhouse"];
$userlog = (isset( $_SESSION['login_user']))?  $_SESSION['login_user'] : '';
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
                            <h5 class="text-center">Tambah Data</h5>
                            </div>
                          </div>
                        
                        </div>
                          <div class="card-body">
                              <div class=" row col-md-12">
                              <div class="col-md-6">
                                    <div class="row mb-12 mb-2">
                                        <label for="transnoHider" style="width:25%" class="col-sm-2 col-form-label">Transno</label>
                                        <div class="col-sm-6">
                                          <input disabled type="text" id="transnoHider"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-12 mb-2">
                                        <label for="tanggal" style="width:25%" class="col-sm-2 col-form-label">Tanggal</label>
                                        <div  style="width: 35%;"  class="col-sm-6">
                                          <input  type="date" id="tanggal" class="form-control">
                                        </div>
                                    </div>

                              </div>
                              <div class="col-md-6">
                                    <div class="row mb-12 mb-2">
                                        <label for="keterangan" style="width:25%" class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-6">
                                          <textarea type="text" style="width:150%" id="keterangan" class="form-control"></textarea>
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
                                        <label for="warehouse" style="width:25%;" class="col-sm-3 col-form-label">From Whsid</label>
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
                                        <label for="warehouse2" style="width:25%;" class="col-sm-3 col-form-label">To Whsid</label>
                                                  <div  class="col-sm-8">
                                                                  <select class="form-control" id="warehouse2">
                                                                  <option value="" disabled selected>Please Select</option>
                                                              <?php  foreach($wherhouse as $file):
                                                                          $kode = $file['whsid'];
                                                                          $nama = $file['whsname'];

                                                                      ?>
                                                            <option value="<?= $kode ?>"><?= $nama ?></option>
                                                              <?php endforeach;?> 
                                                            </select>
                                                                  <span id="warehouse2Error" class="error"></span>
                                                          </div>
                                      </div>
                                        
                                      <div class="row mb-12 mb-2">
                                            <label for="refNo" style="width:25%;" class="col-sm-3 col-form-label">Ref No</label>
                                            <div class="col-sm-6">
                                          
                                              <input type="text" id="refNo" class="form-control">
                                              <span id="refNoError" class="error"></span>
                                            </div>
                                      </div>
                                        <div class="row mb-12 mb-2">
                                            <label for="BatchNo" style="width:25%;" class="col-sm-3 col-form-label">Batch No</label>
                                            <div class="col-sm-6">
                                              <input type="text" id="BatchNo" class="form-control">
                                              <span id="BatchNoError" class="error"></span>
                                            </div>
                                        </div>
                              
                                </div>
                                  <!-- batas row -->
                                  <div class="col-md-6">
                        
                                        <div class="row mb-12 mb-2">
                                            <label for="partid"  style="width:23%;" class="col-sm-2 col-form-label">Part Id</label>
                                            <div class="col-sm-4">
                                            <input type="text" class="form-control" id="partid"></input>
                                            <span id="partidError" class="error"></span>
                                            </div>
                                            
                                        </div>
                                        <div class="row mb-12 mb-2">
                                              <label for="partname"  style="width:23%;" class="col-sm-2 col-form-label">Part Name</label>
                                                  <div  class="col-sm-8">
                                                  <select class="form-control" id="partname"></select>
                                                <span id="partnameError" class="error"></span>
                                                                </div>
                                        </div>
                                        <div class="row mb-12 mb-2">
                                            <label for="pcs"  style="width:23%;" class="col-sm-2 col-form-label">Qty (Pcs)</label>
                                            <div class="col-sm-4">
                                              <input type="number" id="pcs" min=0 value=0 class="form-control">
                                              <span id="pcsError" class="error"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-12 mb-2">
                                            <label for="comment"   style="width:23%;" class="col-sm-2 col-form-label">Comment</label>
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
              <div id="itemTabel"></div>                                                  
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
    const userid ="<?=trim($userlog) ?>";
    if(userid ==""){
      Swal.fire({
                position: 'top-center',
                icon: "info",
                title:"Anda Belum Login Silahkan Login dulu !!",
                showConfirmButton: true,
                  //timer: 1500
                }).then(function(){ 
                  window.location.replace("<?=base_urllogin?>");
                });


    }else{
    
    SetTransno();
    SetTanggal();
      $("#partid").on("change",function(){
        const partid = $(this).val();
        getPartid(partid);
      
      });
    

        $("#partname").on("change",function(){
              const partid = $(this).val();
                $("#partid").val(partid);
            
          });
      //GetdataSelect(userid);
  
   $("#CreateAdd").on("click",function(event){
    event.preventDefault();
  
     let data =validasiinput(event);
     if(data =="whssama"){
        Swal.fire({
          position: "top-center",
          icon: "info",
          title: "From Whs tidak boleh sama dengan To Whs",
          showConfirmButton: true,
          //timer: 1500
        });
        
      }else if(data !==false){
        $("#itemTabel").show();
        $("#CreateAdd").fadeOut();
        $.ajax({
                url:"<?=base_url?>/invtransferfg/Simpandata",
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
      }else if(data ==false){
        Swal.fire({
          position: "top-center",
          icon: "info",
          title: "ada data yang belum di isi",
          showConfirmButton: true,
          //timer: 1500
        });
        
      }
 
    })
    getValidasiData();
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

  function TglSekarang(){
    var d = new Date();
      var month = d.getMonth()+1;
      var day = d.getDate();
      let  output =  d.getFullYear() +'-'+
					(month<10 ? '0' : '') + month + '-' +
				 (day<10 ? '0' : '') + day;

      return output;
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

      let id_trns ="WT"+thn+bln+rep_tgl3;

 
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

      const warehouse2 = $("#warehouse2").find(":selected").val();
    
			if (warehouse2 ==="" || warehouse2 === undefined) {
			  $("#warehouse2Error").text("warehouse2 harus Pilih");
			  event.preventDefault(); // Menghentikan pengiriman formulir jika ada kesalahan
			} else {
			  $("#warehouse2Error").text("");
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
     


	if(warehouse !== "" && warehouse !== undefined &&
        warehouse2 !== "" && warehouse2 !== undefined &&
      partid !== "" && pcs !== "" && pcs !=='0' &&  partname !=="" && partname !==undefined ){

          const datahead ={
            userid:userid,
            tanggal:tanggal,
            transnohider:transnoHider,
            keterangan:keterangan,

          }
          const datadetail ={
            transno:transnoHider,
            refno:refNo,
            batchno:BatchNo,
            warehouse:warehouse,
            warehouse2:warehouse2,
            partid:partname,
            pcs:pcs,
            comment:comment,
         

          }
          let fulldata ={
            datahead:datahead,
            datadetail:datadetail
          }
          
          if(warehouse == warehouse2){
            return "whssama";
          }else{
            return  fulldata;
          }
          //const validasitgl = validasitanggal(tanggal);
          //console.log(validasitgl)
         //console.log(fulldata);
         //
      }else{
          return false;
      }
  }

function validasitanggal(tanggal){
  const tgl_sekarang = TglSekarang();
  split_tgls = tgl_sekarang.split('-');

  console.log(split_tgls)
  
}

 
  function  GetkodeTransada(userid){
    $("#loadingModal").show();
      $.ajax({
                  url:"<?=base_url?>/Inventoriiad/Tampildata",
                  data:{userid:userid},
                  method:"POST",
                  dataType: "json",
                  success:function(result){
                     const datahead = result.datahider;
                     const datadetail = result.datadetail;
                    
                     if(datahead.length == 0){
                      $("#loadingModal").hide();
                      SetTransno();
                      SetTanggal();
                     }else{
                      getListItem();
                      SetdataHider(datahead);
                      SetdataDetail(datadetail);
                     }
  
                  }
      });

  }



   function SetdataHider(datahead){
                let SoTransacID ="";
                let SOEntryDesc ="";
                let Shipdate="";
              $.each(datahead,function(key,value){
                    SoTransacID = value.SoTransacID;
                    SOEntryDesc = value.SOEntryDesc;
                    Shipdate = value.Shipdate;
                  });


              $("#tanggal").val(Shipdate);
              $("#transnoHider").val(SoTransacID);
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
      <button type="btn" onclick="Bataldata()";  class="btn btn-secondary">Batal</button>
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
                 <table id="tabel1" class='table table-striped table-hover' style='width:100%'>                    
                                      <thead  id='thead'class ='thead'>
                                                <tr>
                                                            <th>No</th>
                                                            <th>From Whsid</th>
                                                            <th>To Whsid</th>
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
                  <td>${b.warehouse}</td>
                  <td>${b.warehouse2}</td>
                  <td>${b.Refno}</td>
                  <td>${b.batchno}</td>
                  <td>${b.PartId}</td>
                  <td>${b.PartName}</td>
                  <td>${b.Quantity}</td>
                  <td>${b.keterangan}</td>`;
                  datatabel +=`<td><button   id="edit_row" onclick="edit_row('${transno}','${b.Itemno}','${b.warehouse}','${b.warehouse2}','${b.batchno}', 
                      '${b.Refno}','${b.PartId}','${b.Quantity}','${b.keterangan}');" class="btn"><i class="fa-regular fa-pen-to-square  text-info"></i></i></button></td>`;            
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
	
  function edit_row(transno,itemno,warehouse,whs2,batchno,Refno,PartId,Quantity,keterangan){
	
        $("#edit_row").fadeOut();
        $("#delete").fadeOut();
        $("#warehouse").val(warehouse);
        $("#warehouse2").val(whs2);
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
  }

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



  function Bataldata(){
      let userid = "<?=trim($userlog)?>";
      const transno =$("#transnoHider").val();

      const data ={
        transno:transno,
        userid:userid
      }
      Swal.fire({
                title: "Apakah Anda Yakin Membatalkan inputan ini",
                text: "Batal Input Data Ini!",
                type: "warning",
                showDenyButton: true,
                confirmButtonColor: "#0000FF",
                denyButtonColor: "#757575",
                confirmButtonText: "Ya",
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
                window.location.replace("<?=base_url?>/transferfg/index");
            } 


  function getValidasiData(){
			
      // $("#transtype").blur(function() {
      //  let transtype = $(this).val();
      //  if (transtype ==="" || transtype === undefined) {
      //    $("#transtypeError").text("transtype harus diisi");
      //  } else {
      //    $("#transtypeError").text("");
      //  }
      //  });
   
   
        $("#warehouse").blur(function() {
            let warehouse = $(this).val();
            if (warehouse ==="" || warehouse === undefined){
              $("#warehouseError").text("warehouse harus diisi");
            } else {
              $("#warehouseError").text("");
            }
            });
        
            $("#warehouse2").blur(function() {
            let warehouse = $(this).val();
            if (warehouse ==="" || warehouse === undefined){
              $("#warehous2eError").text("warehouse2 harus diisi");
            } else {
              $("#warehouse2Error").text("");
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