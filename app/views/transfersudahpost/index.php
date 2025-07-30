
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

            <div class="card">
              <div class="card-header">
              <h5 class="text-center">Inventory Transfer FG Posted</h5>
              </div>
              <div class="card-body">
              <div class="row col-md-12">
                   <div  class="col-md-8 mb-3">
                        <form id="form_filter">
                                    <div class=" row col-md-10">
                                      <div style="width:25%;" class="col-md-2">
                                          <select class ="form-control" id="filter_tahun"></select>
                                        </div>
                                  
                                    </div>
                                </form>
                                </br>
                                <div class="col-md-12 mb-3">
                                      <div class="row mb-6 mb-2">
                                          <div class="col-sm-4">
                                            <input  type="text" id="cari"  class="form-control">
                                          </div>
                                          <button  type="btn" class="btn btn-primary col-md-1" id="pencarian" >Cari</button>
                                      </div>
                                      
                                    </div>
                                   
                             
                                </div>
                    </div> 
                 
           
                  <!--    <div class="col-md-4 text-end mb-3">
                                      <a class="btn" href="<?= base_url; ?>/inventori/tambah">
                                      <i class="fa-solid fa-file-circle-plus fa-lg "></i></a>   
                      </div>
            </div>
            </div>-->
                <div id="tabellist"></div>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
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
    //get_tahun();
    //get_bulan();
    //get_status();
    if(userid !==""){
      get_tahun();
      const cari ="NULL";
       get_Data(userid,tahun,cari);
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
        const cari ="NULL";
         get_Data(userid,tahunx,cari);
    });

    $(document).on("click","#pencarian",function(event){
      event.preventDefault();
      let cari = $("#cari").val();
      const  tahun= $("#filter_tahun").val();
      const userid = $("#usernama").val();
      get_Data(userid,tahun,cari);

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
 

      function get_bulan(){
        let seletBulan = $("#filter_bulan");
        const namaBulan = [
          "January", "February", "March", "April", "May", "June",
          "July", "August", "September", "October", "November", "December"
        ];

        for(let a = 0 ; a < namaBulan.length; a++){
          let option = $('<option>',{
            value: a + 1,
            text: namaBulan[a]
          });
          seletBulan.append(option);
        }
      }

      function get_status(){
        let filter_status = $("#filter_status");
        const namaSatus = [
          "All", "Posting", "Sudah Posting"
        ];

        for(let a = 0 ; a < namaSatus.length; a++){
          let option = $('<option>',{
            value: a + 1,
            text: namaSatus[a]
          });
          filter_status.append(option);
        }
      }
      
  function  get_Data(userid,tahun,cari){

    $.ajax({
                  url:"<?=base_url?>/transfersudahpost/sudahposting",
                  data:{"userid":userid,"tahun":tahun,"cari":cari},
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
                                                                <th>No</th>
                                                                <th>Trans No</th>
                                                                <th>Date</th>
                                                                <th style="width:30%">Ket</th>
                                                                <th>User</th>
                                                                <th>Posting</th>
                                                               
                                                    </tr>
                                                    
                                                    </thead>
                                                    <tbody>
                                              
        `;

        let no =1;
              $.each(result,function(a,b){
                
                 const detail = b.detail;

                 let PartId = detail.PartId;
                 let PartName = detail.PartName;
                 let warehouse = detail.warehouse;
                 let Quantity = detail.Quantity;
                 let jml = detail.jumlah_rikode;
                datatabel +=`
                <td>${no++}</td>
                            <td>${b.SoTransacID}<sup class='text-info'>${jml}</sup></td>
                            <td>${b.Shipdate}</td>
                            <td style="width:30%" >${b.ket}</td>
                            <td>${b.UserId}</td>`;
                  datatabel +=`<td>
                                        <form role="form" action="<?= base_url; ?>/transfersudahpost/viewposting" method="POST" target="_blank" enctype="multipart/form-data">
                                              <input type="hidden" class="form-control"name="SoTransacID" value ="${b.SoTransacID}">
                                              <input type="hidden" class="form-control"name="userid" value ="${b.UserId}">
                                              <button type="submit" class="btn btn-warning"><i class="fa-solid fa-arrow-up-right-from-square"></i></button>
                                            </form>
                                  </td>`;            
               
                            datatabel +=`</tr>`;
              });
              datatabel +=`</tbody></table>`;
              $("#tabellist").empty().html(datatabel);
              Tampildatatabel();
          }


      function  Tampildatatabel(){
          const tabel1 = "#tabel1";
          $(tabel1).DataTable({
              order: [[0, 'asc']],
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

