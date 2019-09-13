<?php

   // Start Konfigurasi Koneksi Database
   $dbname     = 'dbtugasesg';
   $dbusername = 'root';
   $dbpassword = '';
   $base_url = "http://localhost/bootcamp";
   $folder_admin = "/bootcamp";

   $dbh = new PDO("mysql:host=localhost;dbname=$dbname", $dbusername, $dbpassword);
   // End Konfigurasi Koneksi Database

   date_default_timezone_set('Asia/Jakarta');//Menyesuaikan waktu dengan tempat kita tinggal
   
   
?>