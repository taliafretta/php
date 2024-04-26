<?php
include '../utils/db_connection.php';

function saveUser($fullName, $email, $password, $birthdate, $phone, $whatsapp, $state, $city) {
    $conn = OpenCon();

    $passwordEncrypted = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO user (fullName, email, password, birthdate, phone, whatsapp, state, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $fullName, $email, $passwordEncrypted, $birthdate, $phone, $whatsapp, $state, $city);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

function getUserByEmail($email) {
    $conn = OpenCon();

    $stmt = $conn->prepare("SELECT fullName, email, birthdate, phone, whatsapp, state, city FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Bind result variables
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        // Fetch result as an associative array
        $user = $result->fetch_assoc();
        return $user;
    } else {
        echo "No user found with that email address.";
        return null;
    }
}