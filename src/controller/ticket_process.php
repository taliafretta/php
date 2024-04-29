<?php
require_once '../model/Ticket.php';
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $attachments = $_FILES['attachments'];
    $attachments = base64_encode($attachments['tmp_name']);

    $created_at = date('Y-m-d H:i:s');
    $updated_at = $created_at;

    $ticket = new Ticket(null, $user_id, $description, $type, $attachments , $created_at, $updated_at);
    $result = $ticket->save();

    if ($result) {
        header('Location: ticket.php');
        exit();
    } else {
        echo "Error saving ticket.";
    }
}
?>

<h1>Teste processamento</h1>