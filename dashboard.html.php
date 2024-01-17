<?php
require '../templates/adminNav.html.php'; ?>

<section class="right"><strong>
        <h2> <?="Welcome  ' " . $_SESSION['logged_user_name'] . " ' " ?> you are Successfully logged In </h2>
    </strong>
    <p><a class="new" href="/Job/Job">Click here to Go to main</a></p>
    <?php
    ?>