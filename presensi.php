 <?php 
  include 'header.php';
  include 'sidebar.php';
?>
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Presensi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Presensi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title" id="timestamp"></h3>
          </div>
          <!-- /.card-header -->
          <form role="form" onsubmit="return presensi()">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama</label>
                  <select class="form-control select2" style="width: 100%;" name="karyawan" id="karyawan">
                    <option value="" selected>-- Pilih --</option>                          
                    <?php 
                        $sql= "SELECT id_karyawan,nama FROM karyawan";
                        $stmt = $dbh->query($sql);
                        while($row = $stmt->fetchObject()){
                          echo "<option value='".$row->id_karyawan."'>".$row->nama."</option>";    
                        }
                     ?>
                   </select>
                </div>
               
       
              </div>

              <div class="col-md-6">
                <label>&nbsp;</label>
                <div class="form-group">
                   <button type="submit" id="submit" name="submit" class="btn btn-primary btn-sm form">Presensi</button>
                </div>
              </div>
             

       
            </div>
            <!-- /.row -->
          </div>
           </form>
        </div>
        <!-- /.card -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php 
    include 'footer.php';
   ?>


<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<script>
      //Tempat Proses Jquery Ajax

     // Function ini dijalankan ketika Halaman ini dibuka pada browser
      $(function(){
      setInterval(timestamp, 1000);//fungsi yang dijalan setiap detik, 1000 = 1 detik
           //Initialize Select2 Elements
        $('.select2').select2({
          theme: 'bootstrap4'
        })
      });

      //Fungi ajax untuk Menampilkan Jam dengan mengakses File ajax_timestamp.php
      function timestamp() {
        $.ajax({
          url: 'ajax/ajax_timestamp.php',
          success: function(data) {
            $('#timestamp').html(data);
          },
        });
      }

      function presensi(){
            $.ajax({
            url : "ajax/ajax_karyawan.php?action=presensi",
            type : "POST",
            data : $('form').serialize(),
            success : function(data){
               alert(data);
            },
            error : function(){
               alert("Presensi Gagal");
            }     
         });
         return false;
      }

     
</script>