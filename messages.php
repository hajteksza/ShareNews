

<?php
include('navbar.html');
?>

<div class="container">
    <div class="row">
        <div class="span4 well" style="padding-bottom:0">
            <form accept-charset="UTF-8" action="" method="POST">
                <input id="email" name="email" required="required" type="text"
                       placeholder="eg. mymail@mail.com">
                <textarea class="span4" id="new_message" name="message"
                          placeholder="Type in your message" rows="5" cols="180"></textarea>
                <button class="btn btn-info" id="button" type="submit">New Message</button>
            </form>
        </div>
    </div>
</div>
</body>

<?php
require("config/connection.php");
require("src/Message.php");
session_start();
if (isset($_POST['email'])) {
    $sql = "SELECT id FROM users WHERE email = '" . $_POST['email'] . "'";
    $result = $conn->query($sql);
    foreach ($result as $row) {
        $id = $row['id'];
    }
    $message = new Message();
    $message->setAuthorId($_SESSION['userId']);
    $message->setContent($_POST['message']);
    if (isset($id)) {
        $message->setReceiverId($id);
    } else {
        echo "The user didn't find in database";
    }
    $message->message($conn);
}

$sql = "SELECT * FROM messages WHERE receiver_id=" . $_SESSION['userId'];
$messages = $conn->query($sql);
foreach ($messages as $row) {
    $sql = "SELECT email FROM users WHERE id=" . $row['author_id'];
    $result = $conn->query($sql);
    foreach ($result as $user) {
        $user = $user['email'];
    }
    echo "<a href=user.php?id=" . $row['author_id'] . ">" . $user . "</a>" . "<br>";
    if ($row['seen'] == 0) {
        echo "<p><b><a href=message.php?id=" . $row['id'] . ">" . $row['content'] . "</b></p></a>";
    } elseif ($row['seen'] == 1) {
        echo "<p><a href=message.php?id=" . $row['id'] . ">" . $row['content'] . "</p>";
    }
}
?>

</html>

