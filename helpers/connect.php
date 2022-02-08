<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ucc_portal;charset=utf8','portal_user', 'secret');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    $response['title'] = 'Database Error';
    $response['error'] = true;
    $response['message'] = 'A database connection error has occured: ' . $e->getMessage() .
               '\nFile: ' . $e->getFile() .
               '\nLine: ' . $e->getLine();
    echo json_encode($response);
}