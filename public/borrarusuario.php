<?php
include '../includes/auth.php';
include '../includes/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    header('Location: login.php');
    exit;
}
$user = getUserById($id);
if ($user) {
    deleteUser($id);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteUser($id);
}

header('Location: Panel.php');
exit;
?>