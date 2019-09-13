<?php
include "../config/koneksi.php";
if($_GET['action'] == "show"){
	$listDate = array();
	$dari = $_POST['dari'];
	$sampai = $_POST['sampai'];
	$dariSplit = explode("-", $dari);
    $dariFinal = $dariSplit[2]."-".$dariSplit[1]."-".$dariSplit[0];
    $sampaiSplit = explode("-", $sampai);
    $sampaiFinal = $sampaiSplit[2]."-".$sampaiSplit[1]."-".$sampaiSplit[0];
	$dariFinalWithTime = strtotime($dariFinal); // Convert date to a UNIX timestamp  
	$sampaiFinalWithTime = strtotime($sampaiFinal); // Convert date to a UNIX timestamp  

	echo '<div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col" width="50" rowspan="2">No</th>
                    <th scope="col" rowspan="2">Nama</th>';
                    
                  
	  
	for ($i=$dariFinalWithTime; $i<=$sampaiFinalWithTime; $i+=86400) {  
		$listDate[] = date("Y-m-d", $i);
	    echo ' <th scope="col" colspan="3" nowrap class="text-center">'.date("d-m-Y", $i).'</th>'; 
	}

	echo '</tr><tr>';
	for ($i=$dariFinalWithTime; $i<=$sampaiFinalWithTime; $i+=86400) {  
	    echo '<th scope="col"nowrap>Jam Masuk</th>'; 
	    echo '<th scope="col"nowrap>Jam Keluar</th>'; 
	    echo '<th scope="col"nowrap>Lama Jam Kerja</th>'; 
	}

	echo '</tr>
            </thead><tbody>';

    $sql= "SELECT id_karyawan,nama FROM karyawan order by nama asc";
    $stmt = $dbh->query($sql);
    $no = 1;
    while($r = $stmt->fetchObject()){
    	echo "<tr><td>$no</td>";
    	echo "<td>$r->nama</td>";
    	foreach ($listDate as $listDateDetail) {
	        $sqlDetail= "SELECT jam_masuk,jam_keluar,TIMEDIFF(jam_keluar,jam_masuk ) AS jaker FROM kehadiran where id_karyawan = '$r->id_karyawan' and tanggal = '$listDateDetail'";
	        $stmtDetail = $dbh->query($sqlDetail);
	  		$dataDetail  = $stmtDetail->fetchObject(); 
			echo "<td>".@$dataDetail->jam_masuk."</td>";
			echo "<td>".@$dataDetail->jam_keluar."</td>";
			echo "<td>".@$dataDetail->jaker."</td>";
        }
        echo "</tr>";

    	$no++;

       
    }
        echo '</tbody></table></div>';
}
?>



	