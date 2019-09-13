<?php
include "../config/koneksi.php";
if($_GET['action'] == "table_data"){
    $sql= "SELECT id_karyawan,nama,jk,no_hp,alamat,nama_jabatan FROM karyawan LEFT JOIN jabatan on karyawan.id_jabatan = jabatan.id_jabatan order by nama asc";
    $stmt = $dbh->query($sql);
    $jumlah = $stmt->rowCount();
    $data = array();
    $no = 1;
    while($r = $stmt->fetchObject()){
       $id = $r->id_karyawan;
       $row = array();
       $row[] = $no;
       $row[] = $r->nama;
       $row[] = $r->jk;
       $row[] = $r->no_hp;
       $row[] = $r->alamat;
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
  $sql= "SELECT id_karyawan,nama,jk,no_hp,alamat,karyawan.id_jabatan FROM karyawan LEFT JOIN jabatan on karyawan.id_jabatan = jabatan.id_jabatan where id_karyawan='$_GET[id]'";
  $stmt = $dbh->query($sql);
  $data  = $stmt->fetchObject();  
  echo json_encode($data);
}elseif($_GET['action'] == "update"){
   $id = $_POST['id'];
  $nama = $_POST['nama'];
   $jabatan = $_POST['jabatan'];
   $no_hp = $_POST['no_hp'];
   $jk = $_POST['jk'];
   $alamat = $_POST['alamat'];

   $sql = "UPDATE karyawan SET nama = :nama,jk=:jk,id_jabatan = :id_jabatan,no_hp = :no_hp,alamat=:alamat WHERE id_karyawan = :id_karyawan";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id_karyawan', $id, PDO::PARAM_STR);
        $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
        $stmt->bindParam(':jk', $jk, PDO::PARAM_STR);
        $stmt->bindParam(':id_jabatan', $jabatan, PDO::PARAM_STR);
        $stmt->bindParam(':no_hp', $no_hp, PDO::PARAM_STR);
        $stmt->bindParam(':alamat', $alamat, PDO::PARAM_STR);
        $result = $stmt->execute(); 

}elseif($_GET['action'] == "insert"){

   $nama = $_POST['nama'];
   $jabatan = $_POST['jabatan'];
   $no_hp = $_POST['no_hp'];
   $jk = $_POST['jk'];
   $alamat = $_POST['alamat'];

   $sql = "INSERT INTO karyawan SET nama = :nama,jk=:jk,id_jabatan = :id_jabatan,no_hp = :no_hp,alamat=:alamat";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
        $stmt->bindParam(':jk', $jk, PDO::PARAM_STR);
        $stmt->bindParam(':id_jabatan', $jabatan, PDO::PARAM_STR);
        $stmt->bindParam(':no_hp', $no_hp, PDO::PARAM_STR);
        $stmt->bindParam(':alamat', $alamat, PDO::PARAM_STR);
        $result = $stmt->execute(); 

}elseif($_GET['action'] == "delete"){
   $sql = "DELETE FROM karyawan WHERE id_karyawan='$_GET[id]'";
   $stmt = $dbh->query($sql);
   $result = $stmt->execute();
}elseif($_GET['action'] == "presensi"){
   $id_karyawan = $_POST['karyawan'];
   $tanggal = date('Y-m-d');
   $jam = date('H:i:s');
   $sql= "SELECT id_karyawan,tanggal,jam_masuk,jam_keluar FROM kehadiran where id_karyawan = '$id_karyawan' and tanggal = '$tanggal'";
   $stmt = $dbh->query($sql);
   $jumlah = $stmt->rowCount();
   $data  = $stmt->fetchObject();  
   if($jumlah>0){
     
    if($data->jam_keluar != ''){
      // Sudah presensi masuk keluar
       echo "Sudah presensi Masuk dan Keluar pada hari ini";
    }else{
      // Sudah presensi masuk tinggal presensi keluar | UPDATE
         $sql = "UPDATE kehadiran SET jam_keluar = :jam_keluar WHERE id_karyawan = :id_karyawan and tanggal = :tanggal";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id_karyawan', $id_karyawan, PDO::PARAM_STR);
        $stmt->bindParam(':tanggal', $tanggal, PDO::PARAM_STR);
        $stmt->bindParam(':jam_keluar', $jam, PDO::PARAM_STR);
        $result = $stmt->execute(); 
        
        echo "Presensi Keluar Berhasil";
    }

   }else{
      // Belum presensi masuk | INSERT
       $sql = "INSERT INTO kehadiran SET id_karyawan=:id_karyawan,tanggal = :tanggal,jam_masuk=:jam_masuk";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id_karyawan', $id_karyawan, PDO::PARAM_STR);
        $stmt->bindParam(':tanggal', $tanggal, PDO::PARAM_STR);
        $stmt->bindParam(':jam_masuk', $jam, PDO::PARAM_STR);
        $result = $stmt->execute(); 

        echo "Presensi Masuk Berhasil";
   }


}


?>