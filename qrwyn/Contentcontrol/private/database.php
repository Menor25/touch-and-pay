<?php
    
    // username = root
    // password = system25$

    $connection = new mysqli('localhost', 'root', 'system25$', 'qrwyndb');
    if($connection->connect_error){
        exit('Error connecting to database');
    }

?>