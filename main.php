<?php
include('navbar.html');
?>

<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <form action="main.php" method="POST">
                <div class="form-group">
                    <textarea rows="5" class="form-control" name="content"></textarea>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Share
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<?php
require('mainengine.php');
?>

</body>

<br>
<br>
<br>




