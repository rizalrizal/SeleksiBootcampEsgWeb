<?php
include "../config/koneksi.php";
if($_GET['action'] == "table_data"){
    $sql= "SELECT id_jabatan,nama_jabatan FROM jabatan order by nama_jabatan asc";
    $stmt = $dbh->query($sql);
    $jumlah = $stmt->rowCount();
    $data = array();
    $no = 1;
    while($r = $stmt->fetchObject()){
       $id = $r->id_jabatan;
       $row = array();
       $row[] = $no;
       $row[] = $r->nama_jabatan;
       $row[] = '<div class="text-center">
                   <button style="color:#fff;" class="btn btn-primary" onclick="form_edit('.$id.')">Ubah</button>
                   <button style="color:#fff;" class="btn btn-danger" onclick="delete_data('.$id.')">Hapus</button>
                 </div>';
       $data[] = $row;
       $no++;
    }
        
    $output = array("draw"=>1,"recordsTotal"=>$jumlah,"recordsFiltered"=>$jumlah,"data" => $data);
    echo json_encode($output);
}elseif($_GET['action'] == "form_data"){
  $sql= "SELECT id_jabatan,nama_jabatan FROM jabatan where id_jabatan='$_GET[id]'";
  $stmt = $dbh->query($sql);
  $data  = $stmt->fetchObject();  
  echo json_encode($data);
}elseif($_GET['action'] == "update"){
   $id = $_POST['id'];
   $nama_jabatan = $_POST['nama_jabatan'];

   $sql = "UPDATE jabatan SET nama_jabatan = :nama_jabatan WHERE id_jabatan = :id_jabatan";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id_jabatan', $id, PDO::PARAM_STR);
        $stmt->bindParam(':nama_jabatan', $nama_jabatan, PDO::PARAM_STR);
        $result = $stmt->execute(); 

}elseif($_GET['action'] == "insert"){

   $nama_jabatan = $_POST['nama_jabatan'];

   $sql = "INSERT INTO jabatan SET nama_jabatan = :nama_jabatan";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':nama_jabatan', $nama_jabatan, PDO::PARAM_STR);
        $result = $stmt->execute(); 

}elseif($_GET['action'] == "delete"){
   $sql = "DELETE FROM jabatan WHERE id_jabatan='$_GET[id]'";
   $stmt = $dbh->query($sql);
   $result = $stmt->execute();
}


?>