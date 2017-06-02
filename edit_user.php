<?php
include('navbar.html');
?>
<html>
<head>
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body>
<div class="col-sm-8">
    <div id="register" class="animate form">
        <form action="" autocomplete="on" method="POST">
            <p>
                <label for="usernamesignup" class="uname">Edit username</label>
                <input id="usernamesignup" name="username" required="required" type="text"
                       placeholder="mysuperusername690"/>
            </p>
            <p class="signin button">
                <input type="submit" value="Edit"/>
            </p>
            <p>
                <label for="emailsignup" class="youmail">Edit email</label>
                <input id="emailsignup" name="email" required="required" type="email"
                       placeholder="mysupermail@mail.com"/>
            </p>
            <p class="signin button">
                <input type="submit" value="Edit"/>
            </p>
            <p>
                <label for="passwordsignup" class="youpasswd">Edit password </label>
                <input id="passwordsignup" name="password" required="required" type="password"
                       placeholder="eg. X8df!90EO"/>
            </p>
            <p class="signin button">
                <input type="submit" value="Edit"/>
            </p>
        </form>
    </div>
</div>
</body>
</html>

<?php
session_start();
include('config/connection.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['password']) {
        $sql = "UPDATE users SET hashed_password='" . password_hash($_POST['password'], PASSWORD_BCRYPT) . "' WHERE
        id=" . $_SESSION['userId'];
        $result = $conn->query($sql);
        echo "Successfully changed";
    } elseif ($_POST['username']) {
        $sql = "UPDATE users SET username='" . $_POST['username'] . "' WHERE id=" . $_SESSION['userId'];
        $result = $conn->query($sql);
        echo "Successfully changed";
    } elseif ($_POST['email']) {

        $result = $conn->query($sql);
        if($result->num_rows == 0) {
            $sql = "UPDATE users SET email='" . $_POST['email'] . "' WHERE id=" . $_SESSION['userId'];
            $result = $conn->query($sql);
            echo "Successfully changed";
        } else {
            echo "There exists given email in database";
        }
    }
}
?>

