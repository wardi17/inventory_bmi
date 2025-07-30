
<?php

$userlog = (isset( $_SESSION['login_user']))?  $_SESSION['login_user'] : '';
?>


<div id="main">
       <header class="mb-3">
       <input type="hidden" id="usernama" class="form-control" value="<?=$userlog?>">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
    <!-- Content Header (Page header) -->
    <div class ="col-md-12 col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
              <h5 class="text-center">Inventory Transfer FG</h5>
              </div>
              <div class="card-body">
              <div class ="row col-md-12 col-12">
                <!-- <h3 class="text-center">Target upload</h3> -->
                  
                    <div  class="col-md-8">
                        <form id="form_filter">
                                    <div class=" row col-md-8">
                                      <div style="width:25%;" class="col-md-2">
                                          <select class ="form-control" id="filter_tahun"></select>
                                        </div>
                                      <!-- <div class="col-md-3">
                                          <select class ="form-control" id="filter_bulan"></select>
                                        </div> -->
                                        <!-- <div class="col-md-3">
                                          <select class ="form-control" id="filter_status"></select>
                                        </div> -->
                                        <!-- <div class="col-md-2">
                                        <button  type="button" name="filterdata" id="filterdata" class="btn btn-primary">Submit</button>
                                        </div> -->
                                    </div>
                                </form>
                
                    </div> 
                 
           
                      <div class="col-md-4 text-end mb-3">
                                      <a class="btn" href="<?= base_url; ?>/transferfg/tambah">
                                      <i class="fa-solid fa-file-circle-plus fa-lg "></i></a>   
                      </div>
         
            </div>
                <div id="tabellist" class="table-responsive"></div>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
      </div>

  <!-- /.content-wrapper -->
     <!-- Modal loadingModal -->
     <div class="modal " id="loadingModal" data-backdrop="static">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-body text-center">
                    <div class="">
                    <img src="dist/loading.gif" alt="Loading..." width="50" height="50">
                    </div>
                    <div>Loading</div>
                  </div>
                </div>
              </div>
            </div>
            <!--and modal -->
  <script>
  $(document).ready(function(){

    const dateya = new Date();
    let bulandefault = dateya.getMonth()+1;
    let tahundefault = dateya.getFullYear();
    let tahun = tahundefault;
    const userid ="<?=trim($userlog) ?>";
    if(userid !==""){
      get_tahun();
      get_Data(userid,tahun);
      $("#filter_tahun").val(tahun);
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
   
    $(document).on("change","#filter_tahun",function(){

        const  tahunx = $(this).val();
        const useridx = $("#usernama").val();
        get_Data(useridx,tahunx);
    })
  
  });
  // and document ready
  function get_tahun(){
       let startyear = 2020;
       let date = new Date().getFullYear();
       let endyear = date + 2;
       for(let i = startyear; i <=endyear; i++){
         var selected = (i !== date) ? 'selected' : date; 

        $("#filter_tahun").append($(`<option />`).val(i).html(i).prop('selected', selected));
       }
      }
 
  function get_Data(userid,tahun){

    $.ajax({
                  url:"<?=base_url?>/invtransferfg/listdata",
                  data:{userid:userid,tahun:tahun},
                  method:"POST",
                  dataType: "json",
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
                    Swal.fire({
                      position: 'top-center',
                      icon: "success",
                      showConfirmButton: false,
                       timer: 1500
                    }).then(function(){ 
                        Set_Tabel(result);
                      
                    });
                     
  
                  }
      });
  }


  function Set_Tabel(result){
    let datatabel = ``;

        datatabel +=`
                    <table id="tabel1" class='table table-striped table-hover' style='width:100%'>                    
                                          <thead  id='thead'class ='thead'>
                                                    <tr>
                                                                <th>Trans No</th>
                                                                <th style="width:20%">Date</th>
                                                                <th>From Whsid</th>
                                                                <th>To Whsid</th>
                                                                <th style="width:30%">Ket</th>
                                                                <th>User</th>
                                                                <th>Posting</th>
                                                                <th>Edit</th>
                                                                <th>View</th>
                                                               
                                                    </tr>
                                                    
                                                    </thead>
                                                    <tbody>
                                              
        `;

        let no =1;
              $.each(result,function(a,b){
                let akseposting = b.akseposting;
                 const detail = b.detail;

                 let PartId = detail.PartId;
                 let PartName = detail.PartName;
                 let jml = detail.jumlah_rikode;
                datatabel +=`
                            <td>${b.SoTransacID}<sup class='text-info'>${jml}</sup></td>
                            <td style="width:20%">${b.Shipdate}</td>
                            <td>${b.gudangfrom}</td>
                            <td>${b.gudangto}</td>
                            <td style="width:30%" >${b.ket}</td>
                            <td>${b.UserId}</td>`;

                  // if(akseposting=='N'){
                  //   datatabel  +=`<td><button type="button"  id="belum_email" style="width:100px"class="btn btn-sm  btn-primary mt-1">Belum Posting</button></td>`;	
                  // }else{
                    datatabel +=`<td>
                                          <form role="form" action="<?= base_url; ?>/transferfg/tampilposing" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" class="form-control"name="SoTransacID" value ="${b.SoTransacID}">
                                                <input type="hidden" class="form-control"name="userid" value ="<?=trim($userlog)?>">
                                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-arrow-up-right-from-square"></i></button>
                                              </form>
                                    </td>`; 
                 // }           
                  datatabel +=`<td>
                                        <form role="form" action="<?= base_url; ?>/transferfg/edit" method="POST" enctype="multipart/form-data">
                                              <input type="hidden" class="form-control"name="SoTransacID" value ="${b.SoTransacID}">
                                              <input type="hidden" class="form-control"name="userid" value ="${b.UserId}">
                                              <button type="submit" class="btn btn-info"><i class="fa-solid fa-file-pen"></i></button>
                                            </form>
                                  </td>`;            
                   datatabel +=`<td>
                                        <form role="form" action="<?= base_url; ?>/transferfg/viewposting" method="POST" target="_blank" enctype="multipart/form-data">
                                              <input type="hidden" class="form-control"name="SoTransacID" value ="${b.SoTransacID}">
                                              <input type="hidden" class="form-control"name="userid" value ="${b.UserId}">
                                              <button type="submit" class="btn btn-warning"><i class="fa-solid fa-arrow-up-right-from-square"></i></button>
                                            </form>
                                  </td>`;  
                            datatabel +=`</tr>`;
              });
              datatabel +=`</tbody></table>`;
              $("#tabellist").empty().html(datatabel);
              Tampildatatabel()
          }

          function  Tampildatatabel(){
            const tabel1 = "#tabel1";
            $(tabel1).DataTable({
                order: [[0, 'desc']],
                  responsive: true,
                  "ordering": true,
                  "destroy":true,
                  pageLength: 5,
                  lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
                  fixedColumns:   {
                      // left: 1,
                        right: 1
                    },
                    
                })
        }



   

</script>

