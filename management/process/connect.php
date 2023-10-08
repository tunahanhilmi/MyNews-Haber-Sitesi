<?php 
    try {
        $db = new PDO("mysql:host=hostname; dbname=dbname; charset=utf8",'username','password');
        //echo 'bağlantı başarılı!!';
        
    } 
    catch (PDOException $e) {
        echo 'hata';
    }

