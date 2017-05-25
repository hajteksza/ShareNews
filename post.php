<?php
include('navbar.html');
?>
<br>
<br>
<br>
</body>

<div class="col-xs4">


<?php

require('config/connection.php');
require('src/Comment.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['comment'])) {
        $content = $_POST['comment'];
        $comment = new Comment();
        $comment->setAuthorId($_SESSION['userId']);
        $comment->setComment($content);
        $comment->setPostId($_GET['id']);
        $comment->comment($conn);
    }
    header('refresh: 1;');
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $sql = "SELECT * FROM posts WHERE id= " . $_GET['id'];
    $result = $conn->query($sql);
    foreach ($result as $row) {
        echo $row['content'] . "<br>";
    }
    $sql = "SELECT * FROM comments JOIN users ON comments.author_id = users.id WHERE comments.post_id=" . $_GET['id'];
    $result = $conn->query($sql);
    foreach ($result as $row) {
        echo $row['username'] . " commented " . $row['date'] . " : ";
        echo $row['comment'] . "<br>";
    }
}
?>

<div class="col-xs4">
