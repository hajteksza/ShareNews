<?php
require('src/Post.php');
require('config/connection.php');

session_start();

if (isset($_GET['action'])) {
    if ($_GET['action'] == "newUser") {
    } elseif ($_GET['action'] == "login") {
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['content'])) {
        $content = $_POST['content'];
        $newPost = new Post();
        $id = $_SESSION['userId'];
        $newPost->setAuthorId($id);
        $newPost->setContent($content);
        $newPost->post($conn);
    }
}

$sql = "SELECT * FROM posts ORDER BY id DESC";
$posts = $conn->query($sql);

foreach ($posts as $row) {
    if (strlen($row['content']) < 30) {
        $content = $row['content'];
    } else {
        $content = substr($row['content'], 0, 30);
        $content .= "...";
    }
    $date = $row['date'];
    $id = $row['id'];
    $sql = "SELECT username FROM users where id=" . $row['author_id'];
    $result = $conn->query($sql);
    foreach ($result as $name) {
        $name = $name['username'];
    }
    echo "
    <div class=\"row\">
        <div class=\"[ col-xs-12 col-sm-offset-1 col-sm-5 ]\">
            <div class=\"[ panel panel-default ] panel-google-plus\">
                <div class=\"panel-heading\">
                    <h3><a href='user.php?id=". $row['author_id'] ."'>" . $name . "</a></h3>
                    <h5><span>Shared publicly</span> - <span>" . $date . "</span> </h5>
                </div>
                <div class=\"panel-body\">
                    <p>" . $content . "       <a href = 'post.php?id=" . $id . "'>See more</a></p>
                </div>
                <form action = 'post.php?id=" . $id . "' method = 'post'>
                <p>
                    <input type = 'text' name = 'comment' style = 'margin-left:20px'>
                    <button type='submit'>Comment</button>
                    </p>
                </form>
                <br>
            </div>
        </div>
        </div>";
}
?>