<?php

function OpenCon()
{
    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // return connection
    return $conn;
}

function CloseCon($conn)
{
    $conn -> close();
}
