<?php 	
	$total = 10;
	echo "<table border='1'>";
	for ($i=1; $i <=10 ; $i++) { 
		echo "<tr>";
		for ($j=1; $j <=10 ; $j++) { 
			$kali = $j*$i;
			echo "<td>$kali</td>";
		}
		echo "</tr>";

	}
	echo "</table>";
?>