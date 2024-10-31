<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "your_password"; // papaltan kung anong password mo sa phpmyadmin
    $db_name = "student_list"; 
    $conn = "";

    $conn = mysqli_connect($db_server, 
                            $db_user,
                            $db_pass, 
                            $db_name);
    
?>