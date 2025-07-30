
<?php
	$mar = $_SESSION['login_user'];


$userlog =$mar ;
?>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
 

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
              <h5 class="text-center">Inventory Movement</h5>
              </div>
              <div class="card-body">
              <div class="row col-md-12">
                  <div  class="col-md-8">
                        <form id="form_filter">
                                    <div class=" row col-md-10">
                                      <div style="width:10%;" class="col-md-2">
                                          <select class ="form-control" id="filter_tahun"></select>
                                        </div>
                                      <div class="col-md-3">
                                          <select class ="form-control" id="filter_bulan"></select>
                                        </div>
                                        <div class="col-md-3">
                                          <select class ="form-control" id="filter_status"></select>
                                        </div> 
                                        <div class="col-md-2">
                                        <button  type="button" name="filterdata" id="filterdata" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                
                    </div>
                 
           
                <!-- <h3 class="text-center">Target upload</h3> -->
                      <div class="col-md-4 text-end mb-3">
                                      <a class="btn" href="<?= base_url; ?>/inventori/tambah">
                                      <i class="fa-solid fa-file-circle-plus fa-lg "></i></a>   
                      </div>
            </div>
            </div>
                <div id="tabellist"></div>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
      </div>
    </section>
  </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
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
    get_tahun();
    get_bulan();
    get_status();
    get_Data(userid,tahun);

  
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
      
  function get_Data(userid,tahun){

    $.ajax({
                  url:"<?=base_url?>/Inventoriiad/listdata",
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
                      if(result !==null){
                        Set_Tabel(result);
                      }
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
                                                                <th>SO No</th>
                                                                <th>Ship Date</th>
                                                                <th>Cust Id</th>
                                                                <th>Part Id</th>
                                                                <th>Part Name</th>
                                                                <th>Warehouse</th>
                                                                <th>Jumlah Qty</th>
                                                                <th>Posting</th>
                                                                <th>Edit</th>
                                                                <th>View</th>
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
                
                datatabel +=`
                            <td>${no++}</td>
                            <td>${b.SoTransacID}</td>
                            <td>${b.Shipdate}</td>
                            <td>${b.UserId}</td>
                            <td>${PartId}</td>
                            <td>${PartName}</td>
                            <td>${warehouse}</td>
                            <td>${Quantity}</td>`;
                  datatabel +=`<td>
                                        <form role="form" action="<?= base_url; ?>/inventori/tampilposing" method="POST" enctype="multipart/form-data">
                                              <input type="hidden" class="form-control"name="SoTransacID" value ="${b.SoTransacID}">
                                              <input type="hidden" class="form-control"name="userid" value ="${b.UserId}">
                                              <button type="submit" class="btn btn-primary"><i class="fa-solid fa-arrow-up-right-from-square"></i></button>
                                            </form>
                                  </td>`;            
                  datatabel +=`<td>
                                        <form role="form" action="<?= base_url; ?>/inventori/edit" method="POST" enctype="multipart/form-data">
                                              <input type="hidden" class="form-control"name="SoTransacID" value ="${b.SoTransacID}">
                                              <input type="hidden" class="form-control"name="userid" value ="${b.UserId}">
                                              <button type="submit" class="btn btn-info"><i class="fa-solid fa-file-pen"></i></button>
                                            </form>
                                  </td>`;            

                            datatabel +=`</tr>`;
              });
              datatabel +=`</tbody></table>`;
              $("#tabellist").empty().html(datatabel);

          }


      function PostingInv(SoTransacID,UserId){

      }



   

</script>

