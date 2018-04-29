<?php

    include 'dbConnection.php';
        
    $conn = connectToDB("lab8");
    
    $username = $_GET['username'];
    
    //next query allows SQL Injection!
    // $sql = "SELECT * FROM lab8_user WHERE username = '$username' ";
    $sql = "SELECT * FROM lab8_user WHERE username = :username ";
    
    $stmt = $conn -> prepare($sql);
    $stmt -> execute( array(":username" => $username) );
    $record = $stmt -> fetch(PDO::FETCH_ASSOC);
    
    //print_r ($record);
    echo json_encode($record);

?>