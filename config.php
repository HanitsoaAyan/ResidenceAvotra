<?php
    $host = "localhost";
    $dbname = "Residence";
    $username = "laravel";
    $password = "Azertyuiop123!";

    try 
    {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username,$password);
    } 
    catch (PDOException $e) 
    {
        die("Erreur de connexion : " . $e->getMessage());
    }
?>