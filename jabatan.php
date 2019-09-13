 <?php 
  include 'header.php';
  include 'sidebar.php';
?>
<!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Jabatan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Jabatan</li>
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
              <h3 class="card-title" style="margin-top: 10px;">Data Jabatan</h3>
              <button type="button" class="btn btn-primary float-right card-title" onclick="form_add()">Tambah Data</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
             <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col" width="50">No</th>
                    <th scope="col">Nama Jabatan</th>
                    <th scope="col" width="200">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- List Data Menggunakan DataTable -->              
                </tbody>
              </table>
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


  <!-- START Modal Form -->

  <div class="modal fade" id="modaljabatan" tabindex="-1" role="dialog" aria-labelledby="modaljabatan" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                  <form onsubmit="return save_data()">
                  <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Tambah Jabatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="nama_jabatan">Nama Jabatan</label>
                          <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan">
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <div class="mr-auto">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> 

                      </div>
                    </div>
                  </div>
                  </form>
                  </div>
                </div>

  <!-- END Modal Form -->


  <?php 
    include 'footer.php';
   ?>

   <!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



<script>
      //Tempat Proses Jquery Ajax
      
      var save_method, table,pesan;
      //Menerapkan plugin datatables
      $(function(){
         table = $('.table').DataTable( {
                "processing": true,
                "ajax": "ajax/ajax_jabatan.php?action=table_data"
            } );
         });

      function form_add(){
         save_method = "add";
         $('#modaljabatan').modal('show');
         $('#modaljabatan form')[0].reset();
         $('.modal-title').text('Tambah Jabatan');
      }

      function form_edit(id){
           save_method = "edit";
           $.ajax({
              url : "ajax/ajax_jabatan.php?action=form_data&id="+id,
              type : "GET",
              dataType : "JSON",
              success : function(data){
                 $('#modaljabatan').modal('show');
                 $('.modal-title').text('Ubah Jabatan');
              
                 $('#id').val(data.id_jabatan);
                 $('#nama_jabatan').val(data.nama_jabatan);
              },
              error : function(){
                 alert("Tidak dapat menampilkan data!");
              }
           });
      }

      function save_data(){
         if(save_method == "add"){
            url = "ajax/ajax_jabatan.php?action=insert";
            pesan = "Berhasil Disimpan";
         }else{ 
            url = "ajax/ajax_jabatan.php?action=update";
            pesan= "Berhasil Diubah";
         }

         $.ajax({
            url : url,
            type : "POST",
            data : $('#modaljabatan form').serialize(),
            success : function(){
               $('#modaljabatan').modal('hide');
               $('#modaljabatan form')[0].reset();
               alert(pesan);
               table.ajax.reload();         
            },
            error : function(){
               alert("Tidak dapat menyimpan data!");
            }     
         });
         return false;
      }

      function delete_data(id){
         if(confirm("Apakah yakin data akan dihapus?")){
            $.ajax({
               url : "ajax/ajax_jabatan.php?action=delete&id="+id,
               type : "GET",
               success : function(data){
                  alert("Data Berhasil Dihapus")
                  table.ajax.reload();
               },
               error : function(){
                  alert("Tidak dapat menghapus data!");
               }
            });
         }
      }

</script>