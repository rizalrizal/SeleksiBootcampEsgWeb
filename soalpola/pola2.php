<?php 
    $limit = 9;
    $space = $limit;
    $revenge=1;
 
    for ($i = 1; $i <= $limit; $i++) {
        for ($j = 1; $j <= $space; $j++) {
            echo "&nbsp;&nbsp;&nbsp;";
        }

        $space--;
 
        for ($j = 1; $j <= 2 * $i - 1; $j++) {
              echo "&nbsp;";
            if($j<=$i){
                echo $j;    
            }else{
                echo $i-$revenge;
                $revenge = $revenge+1;    
            }
        }

        $revenge=1;
        echo "<br>";
    }
 
    $space = 2;
 
    for ($i = 1; $i <= $limit; $i++) {
        $iRevenge = $limit-$i;
        for ($j = 1; $j <= $space; $j++) {
            echo "&nbsp;&nbsp;&nbsp;";
        }
        $space++;
 
        for ($j = 1; $j <= 2 * ($limit - $i) - 1; $j++) {
              echo "&nbsp;";
            if($j<=$iRevenge){
                echo $j;    
            }else{
                echo $iRevenge-$revenge;
                $revenge = $revenge+1;    
            }
        }
        $revenge=1;
        echo "<br>";
    }
 ?>