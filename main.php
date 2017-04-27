<!DOCTYPE html>
<head>
    <meta charset="UTF-8"/>
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
    <title>Sharenews</title>
    <link rel="stylesheet" type="text/css" href="style/style2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>

<div class="container">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
                        class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">ShareNews</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="main.php"><span class="glyphicon glyphicon-home"></span>Strona Główna</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"><a href="messages.php" class="dropdown-toggle" data-toggle="dropdown"><span
                                class="glyphicon glyphicon-envelope"></span>Skrzynka <span
                                class="label label-info">...</span>
                    </a>
                </li>
                <li class="dropdown"><a href="user.php" class="dropdown-toggle" data-toggle="dropdown"><span
                                class="glyphicon glyphicon-user"></span>Użytkownik </a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div>

<?php

require ('src/Post.php');
require ('config/connection.php');

session_start();

if (isset($_GET['action'])) {
    if ($_GET['action'] == "newUser") {
    } elseif ($_GET['action'] == "login") {
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $content = $_POST['content'];
    $newPost = new Post();
    $newPost->setAuthorId($_SESSION['userId']);
    $newPost->setContent($content);
    $newPost->post($conn);
}

$posts = Post::loadAllPosts($conn);

?>

<br>
<br>
<br>

<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <form action="main.php" method="POST">
                <p>
                <div class="form-group">
                    <textarea rows="5" class="form-control" name="content"></textarea>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Share
                    </button>
                </div>
                </p>
            </form>
        </div>

    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-6">
            <div id="postlist">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="text-center">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h3 class="pull-left">Welcome</h3>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="pull-right">
                                        <small><em>2014-07-30<br>18:30:00</em></small>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in... <a href="#">Read more</a>
                    </div>

                    <div class="panel-footer">
                        <span class="label label-default">Welcome</span> <span
                                class="label label-default">Updates</span> <span class="label label-default">July</span>
                    </div>
                </div>

