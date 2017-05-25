
<?php

include('config/connection.php');
include('navbar.html');

if($_SERVER['REQUEST_METHOD'] == "GET") {
    if($_GET['id']) {
        $sql = "UPDATE messages SET seen = 1 WHERE id=" . $_GET['id'];
        $result = $conn->query($sql);
        $sql = "SELECT * FROM messages WHERE id=" . $_GET['id'];
        $result = $conn->query($sql);
        foreach ($result as $row) {
            echo "Content: " . $row['content'];
        }
    }
}