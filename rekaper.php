 <?php 
  include 'header.php';
  include 'sidebar.php';
?>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rekap Presensi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rekap Presensi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="margin-top: 10px;">Data Rekap Presensi</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form role="form" onsubmit="return show()">
              <div class="form-row">
              <div class="form-group col-md-3">
                <label for="Dari">Dari</label>
                <input type="date" class="form-control" name="dari" id="dari" required>
              </div>
              <div class=" form-group col-md-1 text-center">
                
                <label style="margin-top: 35px;">s/d</label>
              </div>
              <div class="form-group col-md-3">
                <label for="Sampai">Sampai</label>
               <input type="date" class="form-control" name="sampai" id="sampai" required>
              </div>
                 <div class="form-group col-md-5">
                    <button style="margin-top: 35px;" type="submit" id="submit" name="submit" class="btn btn-primary btn-sm form">Submit</button>
                 </div>
              </div>
              </form>

              <div id="data_kehadiran">
                
              </div>

             


            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php 
    include 'footer.php';
   ?>




<script>
      //Tempat Proses Jquery Ajax
        function show(){
           $.ajax({
              url : "ajax/ajax_kehadiran.php?action=show",
              type : "POST",
              data : $('form').serialize(),
              success : function(data){

                $('#data_kehadiran').html(data);   
                  
              },
              error : function(){
                 alert("Tidak dapat menampilkan data!");
              }
           });
           return false;
      }
      

</script>